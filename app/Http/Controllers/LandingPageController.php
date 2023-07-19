<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LandingPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('LandingPage');
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
            'grilled_meat' => 'required',
            'grilled_chicken' => 'required',
            'tea_cups' => 'required',
            'comments' => 'required',
        ]);
        dd($reservation);
        Reservation::create([
            'grilled_meat' => $request->grilled_meat,
            'grilled_chicken' => $request->grilled_chicken,
            'tea_cups' => $request->tea_cups,
            'comments' => $request->comments,
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
