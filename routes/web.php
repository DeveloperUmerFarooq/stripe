<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('stripe');
});

Route::post('/stripe',function(Request $request){
    $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
    $charge=$stripe->charges->create([
    'amount' => 1099*100,
    'currency' => 'pkr',
    'source' => $request->stripeToken,
    'description'=>"payment for products"
    ]);
    return "payment successful";
})->name('stripe.payment');
