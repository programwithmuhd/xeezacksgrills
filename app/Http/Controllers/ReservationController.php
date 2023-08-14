<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Reservation');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $reservation = $request->validate([
            'name' => 'required',
            'phone' => 'required|digits:11',
            'email' => 'nullable|string|email|max:255',
            'grilled_meat' => 'required',
            'grilled_chicken' => 'required',
            'tea_cups' => 'required',
        ]);
        // dd($reservation);
        Reservation::create([
            'name' => $request->get('name'),
            'phone' => $request->get('phone'),
            'email' => $request->get('email'),
            'grilled_meat' => $request->get('grilled_meat'),
            'grilled_chicken' => $request->get('grilled_chicken'),
            'tea_cups' => $request->get('tea_cups'),
            'comments' => $request->get('comments'),
        ]);

        return to_route('landing-page.index');
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
