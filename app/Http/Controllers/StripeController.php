<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe;
class Controller{
    function indx($abv){
        return abc;
    }
}
class StripeController extends Controller
{
     function indx($abv){
        return abc;
    }

   public function handlePost(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
                "amount" => 100 * 150,
                "currency" => "inr",
                "source" => $request->stripeToken,
                "description" => "Making test payment."
        ]);

        // Session::flash('success', 'Payment has been successfully processed.');

        return response()->json(['success'=>'Payment has been successfully processed.']);
    }
}
