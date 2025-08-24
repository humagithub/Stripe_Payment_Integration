@extends('stripe-integration.layout')

@section('content')
<h2>Stripe Payment - Add Card Number</h2>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

@if(session('error'))
    <p style="color: red;">{{ session('error') }}</p>
@endif

<form action="{{ route('stripe.process') }}" method="POST" id="payment-form">
    @csrf
    <div id="card-element"></div>
    <input type="hidden" name="amount" value="5063">
    <button class="pay-now" type="submit" id="submit-button">Pay Now</button>
</form>
<a href="{{ route('stripe.index') }}"><button class="pay-now">Back</button></a>

<script>
    var stripe = Stripe("{{ config('services.stripe.public') }}");

        var elements = stripe.elements();
    var card = elements.create('card');
    card.mount('#card-element');

    var form = document.getElementById('payment-form');
    var submitButton = document.getElementById('submit-button');

    form.addEventListener('submit', function(event) {
        event.preventDefault();
        submitButton.disabled = true;

        stripe.createToken(card).then(function(result) {
            if (result.error) {
                alert(result.error.message);
                submitButton.disabled = false;
            } else {
                var hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripeToken');
                hiddenInput.setAttribute('value', result.token.id);
                form.appendChild(hiddenInput);
                form.submit();
            }
        });
    });
</script>
@endsection
