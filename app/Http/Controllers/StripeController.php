<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StripeController extends Controller
{
    public function checkout(Request $req)
    {
        \Stripe\Stripe::setApiKey(config('stripe.sk'));

        $session = \Stripe\Checkout\Session::create([
            // 'payment_method_types' => ['card'], //se puede elegir el metodo de pago
            'line_items' => [[ // informaciòn del producto
                'price_data' => [ //informacion del precio
                    'currency' => 'usd', //moneda
                    'product_data' => [ //informacion del producto
                        'name' => $req->name, //nombre del producto
                    ],
                    'unit_amount' => intval($req->price * 100), //hay que pasar el precio en centavos en un int
                ],
                'quantity' => 1, //cantidad
            ]],
            'mode' => 'payment', //modo de pago
            'success_url' => route('succes'), //url de exito
            'cancel_url' => route('index'), //url de cancelacion
        ]);

        return redirect()->away($session->url)
        ->with('stripe_id', $session->id)
        ->with('product_id', $req->product_id);
    }

    public function succes()
    {
        //dd(session('stripe_id'), session('product_id'));
        DB::table('purchases')->insert([
            'stripe_id' => session('stripe_id'),
            'product_id' => session('product_id'),
            'user_id' => Auth::user()->id,
        ]);
        return redirect()->route('purcheases');
    }

    public function index()
    {
        return 'ha ocurrido un error';
    }
}
