<html>
<head>
    <style>
        @font-face {
            font-family: 'Roboto';
            src: url({{ storage_path('fonts/Roboto-Regular.ttf') }}) format("truetype");
            font-weight: normal;
            font-style: normal;
            font-variant: normal;
        }

        html {
            margin: 0;
        }

        html, body {
            font-family: Roboto, Arial, Sans-Serif;
        }

        p {
            margin: 0;
        }

        .mt-1 {
            margin-top: .25rem;
        }

        .mt-2 {
            margin-top: .5rem;
        }

        .mt-3 {
            margin-top: .75rem;
        }

        .mt-4 {
            margin-top: 1.25rem;
        }

        .mt-5 {
            margin-top: 2rem;
        }


        /*------ INVOICE HEADER ------*/

        .invoice-header {
            color: #494949;
            width: 100%;
            padding: 1.5rem;
            background: #F5F5F6;
        }

        .invoice-header .brand {
            text-align: left;
            position: relative;
            vertical-align: middle;
        }

        .invoice-header .brand img {
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            width: 170px;
        }

        .invoice-header .brand .title {
            margin-left: 216px;
            font-size: 52px;
            font-weight: bold;
        }


        .invoice-header .company {
            text-align: right;
        }


        /*------ CUSTOMER HEADER ------ */

        .customer-header {
            width: 100%;
            padding: 1rem;
        }

        .customer-header td {
            width: 33.33%;
            vertical-align: top;

        }

        .customer-header .description-title {
            font-weight: bold;
            color: #A4A4A4;
        }

        .customer-header .description p {
            font-size: 32px;
            color: #494949;
            font-weight: bold;
        }

        .customer-header .total {
            text-align: right;
        }

        .customer-header .total .amount {
            font-size: 70px;
            font-weight: bold;
            color: #A4A4A4;
        }


        /*----- ARTICLES ----- */


        .articles {
            width: 100%;
            margin-left: 1rem;
            margin-right: 1rem;
            border-collapse: collapse;
        }


        .articles tr:first-child td {
            border-top: 8px solid #A4A4A4;
            color: #A4A4A4;
            font-weight: bold;
            padding: 1rem 0;
        }

        .articles td:first-child {
            width: 45%;
        }


        .articles .item td {
            border-bottom: 4px solid #F5F5F6;
            color: #494949;
            font-weight: bold;
            padding: 1.5rem 0;
        }


    </style>
</head>

<body>

<!-- INVOICE HEADER -->
<table class="invoice-header">
    <tr>

        <td class="brand">

            <img src="{{asset('img/azell_logo.png')}}" alt="Azell Logo">
            <div class="title">{{__('cart.invoice')}}</div>

        </td>
        <td class="company">
            <p>+521 427 1822 721</p>
            <p>finanzas@azellft.com</p>
            <p>
                {{__('cart.visit_us')}}<b> <a href="https://azellft.com">azellft.com</a></b>
            </p>

        </td>
    </tr>
</table>

<!-- INVOICE HEADER -->


<!--CUSTOMER HEADER -->
<table class="customer-header mt-5">
    <tr>
        <td>
            <p class="description-title">
                {{__('cart.issued_to')}}
            </p>

            <div class="description mt-3">
                <p>{{$payment->buyer->profile->name}}</p>
                <p class="mt-2">{{$payment->buyer->email}}</p>
                <p class="mt-2">{{$payment->buyer->profile->phone_number}}</p>
            </div>

        </td>
        <td>
            <p class="description-title">
                {{__('cart.invoice_id')}}
            </p>

            <div class="description mt-1">
                <p>{{$payment->payment_uuid}}</p>
            </div>


            <p class="description-title mt-4">
                {{__('cart.payment_date')}}
            </p>

            <div class="description">
                <p class="description mt-1">{{$payment->created_at->format('d/m/Y h:i a')}}</p>
            </div>

        </td>
        <td class="total">
            <p class="description-title">
                {{__('cart.total')}}
            </p>
            <p class="amount mt-3">{{number_format($payment->total,2)}} {{$payment->currency->iso_code}}</p>
        </td>
    </tr>
</table>

<!-- CUSTOMER HEADER -->

<!-- ARTICLES -->

<table class="articles mt-5">
    <tr>
        <td align="left">{{__('cart.item')}}</td>
        <td align="center">{{__('cart.price')}}</td>
        <td align="center">{{__('cart.quantity')}}</td>
        <td align="right">Subtotal</td>
    </tr>

    @foreach($payment->details as $detail)
        <tr class="item">
            <td align="left">{{$detail->description}}</td>
            <td align="center">{{number_format($detail->price,2)}}</td>
            <td align="center">{{$detail->quantity}}</td>
            <td align="right">{{number_format($detail->subtotal,2)}}</td>
        </tr>
    @endforeach
    <tr class="item">
        <td colspan="2"></td>
        <td align="center">Subtotal</td>
        <td align="right">{{number_format($payment->subtotal,2)}}</td>
    </tr>
    <tr class="item">
        <td colspan="2"></td>
        <td align="center">{{__('cart.tax')}}</td>
        <td align="right">{{number_format($payment->tax,2)}}</td>
    </tr>
</table>

<!-- ARTICLES -->


</body>
</html>




