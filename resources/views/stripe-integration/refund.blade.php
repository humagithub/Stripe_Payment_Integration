@extends('stripe-integration.layout')

@section('content')
<h2>Stripe Payment Refund</h2>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

@if(session('error'))
    <p style="color: red;">{{ session('error') }}</p>
@endif

<form action="{{ route('stripe.refund') }}" method="POST">
    @csrf
    <input type="text" name="charge_id" placeholder="Enter Stripe Charge ID" required>
    <button class="pay-now" style="background-color:red;" type="submit">Request Refund</button>
</form>
<a href="{{ route('stripe.index') }}"><button class="pay-now">Back</button></a>

@endsection
