<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use AmrShawky\LaravelCurrency\Facade\Currency;
use App;
class CurrencyController extends Controller
{
      public function ConvertCurrency($to){
        $converted=Currency::convert()
            ->from('INR') //currncy you are converting
            ->to($to)     // currency you are converting to
            ->amount(1) // amount in USD you converting to EUR
            ->get();
            // dd($converted);
        App::setLocale($to);
        session()->put("currency_code", $to);
        session()->put("currency_rate", $converted);
        return redirect('/');
    }
}
