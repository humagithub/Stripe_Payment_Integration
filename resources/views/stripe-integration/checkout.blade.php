@extends('stripe-integration.layout')

@section('content')
<h2>Stripe Payment with Checkout Page</h2>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

@if(session('error'))
    <p style="color: red;">{{ session('error') }}</p>
@endif

<form action="{{ route('stripe.checkout') }}" method="POST">
    @csrf
    <input type="hidden" name="amount" value="1000"> <!-- $10 -->
    <button class="pay-now" type="submit">Pay with Stripe</button>
</form>
<a href="{{ route('stripe.index') }}"><button class="pay-now">Back</button></a>

@endsection
