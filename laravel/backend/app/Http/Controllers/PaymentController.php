<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Stripe\Charge;
use Stripe\Stripe;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Traits\ConvertCurrencyTrait;

use Illuminate\Support\Facades\View;

class PaymentController extends Controller
{
    public function getStripeForm() {
        return View::make('user.payment');
    }

    public function postStripePayment(Request $r) {
        Stripe::setApiKey(env('STRIPE_SECRET'));

		// amount 
        $price = $this->convertWithEnvRate($r->credits) * 100;
		$currentUser = Auth::user();

		$description = "De gebruiker " . 
			$currentUser->name . 
			" heeft credits aangekocht";


		$charge = Charge::create([
			'amount' 	=> $price,
			'currency' 	=> 'eur',
			'source' 	=> $r->stripeToken,
			'description' => $description
		]);

		if($charge->status == 'succeeded') {
			
			$currentUser->credits += $r->credits;
			$currentUser->save();

			$r->session()->flash('success', 
				'Je hebt succesvol ' . $r->credits . ' credits aangekocht'
			);
		}
		else {
			$r->session()->flash('error', 'Aj aj aj');
		}

		return back();
    }

    public function convertWithEnvRate($amount, $from = 'credits', $to = 'euro', $precision = 2) {

        $ratio = env('CREDIT_RATIO');

        if($from == 'credits') {
            $convert = round($amount * $ratio, $precision);
        } else {
            $convert = round($amount / $ratio, 0);
        }

        return $convert;
    }
}
