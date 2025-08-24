@extends('stripe-integration.layout')

@section('content')
<h2>Choose Stripe Payment Option</h2>
<a href="{{ route('stripe.card') }}"><button class="pay-now">Card Payment</button></a>
<a href="{{ route('stripe.checkout.form') }}"><button class="pay-now">Checkout Payment</button></a>
<a href="{{ route('stripe.refund.form') }}"><button class="pay-now" style="background-color:red;">Refund</button></a>
@endsection
