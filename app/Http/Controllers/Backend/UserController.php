<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Users/UsersIndex', [
            'users' => User::all()
        ]);
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
    public function edit(User $user)
    {
        return Inertia::render('Users/UsersEdit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(User $user, Request $request): RedirectResponse
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'mobile_number' => 'required|digits:11',
            'email' => 'required|string|email|max:255',
            'password' => ['required'],
        ]);

        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');
        $user->mobile_number = $request->get('mobile_number');
        $user->email = $request->get('email');
        $user->password = $request->get('password');

        $user->update();

        return to_route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            $user = User::find($id);
            $user->delete();
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }
}