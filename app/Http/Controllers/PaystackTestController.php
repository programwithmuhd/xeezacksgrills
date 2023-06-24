<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaystackTestController extends Controller
{
    public function initiate()
    {
        $formData = [
            'email' => request('email'),
            'amount' => request('amount') * 100,
            'callback_url' => route('pay.callback'),
        ];

        $pay = json_decode($this->makePayment($formData));
        // dd($pay);
        if ($pay->status) {
            return redirect($pay->data->authorization_url);
        } else {
            return redirect('/');
        }
    }

    public function makePayment($formData)
    {
        $url = "https://api.paystack.co/transaction/initialize";

        $fields_string = http_build_query($formData);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer SECRET_KEY',
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
                'Authorization: Bearer SECRET_KEY',
                'Cache-Control: no-cache',
            ]
        ]);

        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    public function paymentCallBack()
    {
        $response = json_decode($this->verifyPayment(request('reference')));
        // dd($response);
        $data = $response->data
        // return view('/', ['data' => $data]);return success page
    }
}