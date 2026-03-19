<?php

namespace App\Http\Controllers\Mail;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Resend\Laravel\Facades\Resend;

class ResendController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        //$order = Order::findOrFail($request->order_id);

        // Ship the order...

        Resend::emails()->send([
            'from' => 'Ludexis <antoniomedi6@gmail.com>',
            'to' => [$request->user()->email],
            'subject' => 'Bienvenido a Ludexis',
            //'html' => (new OrderShipped($order))->render(),
        ]);

        return redirect('/');
    }
}