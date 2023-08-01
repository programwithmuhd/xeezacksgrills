<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Inertia\Inertia;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{

    public function index()
    {
        return Inertia::render('Checkout', [
            'menus' => Menu::orderBy('created_at', 'desc')
            ->get()
            ->map(function ($menu) {
                return [
                    'id' => $menu->id,
                    'category_id' => $menu->category_id,
                    'name' => $menu->name,
                    'slug' => $menu->slug,
                    'description' => $menu->description,
                    'price' => $menu->price,
                    'image' => asset('/images/menus/' . $menu->image),
                ];
            }),
        ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function initiate()
    {
        $formData = [
            
            // 'state' => request('last_name'),
            // 'city' => request('city'),
            // 'phone_number' => request('phone_number'),
            // 'first_name' => request('first_name'),
            // 'last_name' => request('last_name'),
            'email' => request('email'),
            'phone' => request('phone'),
            // 'state' => request('state'),
            // 'city' => request('city'),
            'amount' => request('amount') * 100,
            // 'addr1' => request('addr1'),
            // 'addr1' => request('addr1'),
            'callback_url' => route('checkout.callback'),
        ];

        $pay = json_decode($this->initializePayment($formData));
        // dd($pay);
        if ($pay->status) {
            $url = $pay->data->authorization_url;
            return Inertia::location($url);
        } else {
            return back()->withErrors($pay->message);
        }
    }

    public function initializePayment($formData)
    {
        $url = "https://api.paystack.co/transaction/initialize";

        $fields_string = http_build_query($formData);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer ' . env('PAYSTACK_SECRET_KEY'),
            'Cache-Control: no-cache',
        ));

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    public function verifyPayment($reference)
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.paystack.co/transaction/verify/$reference",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer ' . env('PAYSTACK_SECRET_KEY'),
                'Cache-Control: no-cache',
            ]
        ]);

        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function paymentCallBack()
    {
        $response = json_decode($this->verifyPayment(request('reference')));
        // dd($response);
        return Inertia::render('CheckoutSuccess');
        // return redirect()->route('checkout.callback');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}