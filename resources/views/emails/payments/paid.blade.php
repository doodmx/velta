@component('mail::message')
<h1>¡ {{__('cart.nice_day')}} <b>{{$payment->buyer->profile->lastname}} {{$payment->buyer->profile->name}}</b>!</h1>

{{__('cart.payment_received')}} <b>{{$payment->payment_uuid}}


@component('mail::table')
@foreach($payment->details as $detail)
|  {{__('cart.item')}}                           | {{__('cart.quantity')}}  |  {{__('cart.price')}}               | Subtotal                               |
| ---------------------------------------------- | :-----------------------:| :----------------------------------:| -----------------------------------:   |
| {{$detail->description}}                       | {{$detail->quantity}}    | {{number_format($detail->price,2)}} | {{number_format($detail->subtotal,2)}} |

@endforeach
@endcomponent



@component('mail::table')
|                   |                                                                                               |
|:------------------|----------------------------------------------------------------------------------------------:|
|Subtotal           | {{number_format($payment->subtotal,2)}}                                                       |
|{{__('cart.tax')}} | {{number_format($payment->tax,2)}}                                                            |
|<b>Total</b>       | <b>{{number_format($payment->total,2)}} {{$payment->currency->iso_code}}</b>                  |
@endcomponent

{{__('cart.regards')}},<br>
{{ config('app.name') }}
@endcomponent
