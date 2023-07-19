<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\AddressStoreRequest;
use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Address/Add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'mobile_number' => 'required|digits:11',
            'email' => 'required|string|email|max:255|unique:'.User::class,
            'password' => ['required'],
            'state' => ['required'],
            'city' => ['required'],
            'district' => ['required'],
            'address' => ['required'],
        ]);

        try {
            DB::transaction(function() use ($request) {
                $user = User::create([
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'mobile_number' => $request->mobile_number,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);

                $userId = $user->getKey();

                $address = new Address([
                    'user_id' => $userId,
                    'state' => $request->input('state'),
                    'city' => $request->input('city'),
                    'district' => $request->input('district'),
                    'address' => $request->input('address')
                ]);

                $user->address()->save($address);
            });
        } catch(\Exception $e) {
            return response()->json($e->getMessage());
        }

        // customer_id, state, city

        // event(new EventsCustomer($customer));

        return redirect(RouteServiceProvider::HOME);


        // try {
        //     $address = new Address;

        //     $address->user_id = auth()->user()->id;
        //     $address->state = $request->get('state');
        //     $address->city = $request->get('city');
        //     $address->district = $request->get('district');
        //     $address->address = $request->get('address');

        //     $address->save();

        //     return redirect()->route('landing-page.index');
        // } catch (\Exception $e) {
        //     return response()->json($e->getMessage());
        // }
    }

    /**
     * Display the specified resource.
     */
    public function show(Address $address)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Address $address)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Address $address)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            $address = Address::find($id);
            $address->delete();
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }
}
