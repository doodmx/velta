<?php

namespace App\Http\Controllers\Payment;

use App\DataTables\PaymentDataTable;
use App\Exceptions\Payment\PaymentException;
use App\Http\Requests\Payment\SendPaymentRequest;
use Illuminate\Support\Facades\Notification;
use PDF;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\PaymentCreated;
use App\Interfaces\Payment\CartInterface;
use App\Interfaces\Payment\PaymentInterface;
use App\Interfaces\Payment\PaymentIntentInterface;
use App\Http\Requests\Payment\CreatePaymentRequest;
use App\Interfaces\Payment\PaymentGatewayInterface;
use App\Interfaces\Partner\PartnerPaymentGatewayInterface;
use App\Interfaces\Payment\PaymentGatewayCustomerInterface;


class PaymentController extends Controller
{


    public function index(PaymentDataTable $paymentDataTable)
    {

        return $paymentDataTable->render('admin.payments.index');
    }

    public function makeIntent(Request $request,
                               PaymentIntentInterface $paymentIntentContract
    )
    {


        $paymentIntent = $paymentIntentContract->makeIntent();

        return response()->json([
            'intent' => $paymentIntent
        ], 200);

    }

    public function charge(CreatePaymentRequest $request,
                           CartInterface $cartContract,
                           PaymentInterface $paymentContract,
                           PaymentGatewayInterface $paymentGatewayContract,
                           PartnerPaymentGatewayInterface $partnerPaymentGatewayContract,
                           PaymentGatewayCustomerInterface $gatewayCustomerContract
    )
    {


        //Fetch the partner ID and Payment Method on the Payment Gateway
        $partnerPaymentGateway = $partnerPaymentGatewayContract
            ->showByGateway(auth()->user()->id, $request['payment_method']);


        if (empty($partnerPaymentGateway)) {

            $partnerGatewayId = $gatewayCustomerContract
                ->save([
                    'name'  => auth()->user()->profile->lastname . ' ' . auth()->user()->profile->name,
                    'email' => auth()->user()->email
                ]);

            $partnerPaymentGateway = $partnerPaymentGatewayContract
                ->save(
                    auth()->user()->id,
                    $request['payment_method'],
                    $partnerGatewayId
                );
        }


        //Make the charge
        $paymentUuid = $paymentGatewayContract
            ->charge(
                $partnerPaymentGateway->uuid,
                $request->all()
            );


        //Save Payment on Database
        $cart = $cartContract->show();
        $payment = $paymentContract->store(
            $cart,
            array_merge(
                $request->all(), [
                    'partner_id' => auth()->user()->id,
                    'uuid'       => $paymentUuid
                ]
            ));


        // Create an invoice and notify it to the buyer
        $receiptPath = storage_path('app/public/payments/') . $paymentUuid . '.pdf';


        $pdf = PDF::loadView('formats.payment', ['payment' => $payment])
            ->setPaper('letter', 'portrait');
        $pdf->save($receiptPath);
        auth()->user()->notify(new PaymentCreated($payment, $receiptPath));


        $cartContract->empty();


        return response()->json(['message' => __('web/cart.regards')], 201);


    }

    public function send($id, SendPaymentRequest $request, PaymentInterface $paymentContract)
    {

        $payment = $paymentContract->show($id);
        $receiptPath = storage_path('app/public/payments/') . $payment->payment_uuid . '.pdf';
        $paymentNotification = new PaymentCreated($payment, $receiptPath);
        $paymentNotification->setSubject($request['subject']);
        $paymentNotification->setBcc(empty($request['bcc']) ? [] : $request['bcc']);

        try {

            Notification::route('mail', $request['email'])
                ->notify($paymentNotification);

            return response()->json(['message' => 'Pago enviado correctamente'], 200);


        } catch (\Exception $exception) {

            throw new PaymentException('Hubo un error al enviar el pago intente nuevamente');
        }


    }

}
