<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;

class Customer
{
    use SerializesModels;


    /**
     * The authenticated user.
     *
     * @var \Illuminate\Contracts\Auth\Authenticatable
     */
    public $customer;

    /**
     * Create a new event instance.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $customer
     * @return void
     */
    public function __construct($customer)
    {
        $this->customer = $customer;
    }
}
