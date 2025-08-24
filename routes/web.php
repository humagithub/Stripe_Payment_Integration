<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StripeController;

Route::get('/', [StripeController::class, 'index'])->name('stripe.index');
Route::get('/stripe/card', [StripeController::class, 'showcardForm'])->name('stripe.card');
Route::get('/stripe/checkout', [StripeController::class, 'showcheckoutForm'])->name('stripe.checkout.form');
Route::get('/stripe/refund', [StripeController::class, 'showrefundForm'])->name('stripe.refund.form');

Route::post('/stripe/refund', [StripeController::class, 'refund'])->name('stripe.refund');
Route::post('/stripe/checkout', [StripeController::class, 'checkout'])->name('stripe.checkout');
Route::get('/stripe/success', [StripeController::class, 'success'])->name('stripe.success');
Route::get('/stripe/cancel', [StripeController::class, 'cancel'])->name('stripe.cancel');

Route::post('/stripe-process', [StripeController::class, 'processPayment'])->name('stripe.process');

