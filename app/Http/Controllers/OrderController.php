<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as RequestFacade;
use Inertia\Inertia;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('orders/OrdersIndex', [
            'orders' => Order::query()
                ->when(RequestFacade::input('search'), function ($query, $search) {
                    $query->where('status', 'LIKE', "%{$search}%");
                })->when(RequestFacade::has('field'), function ($query) {
                    $query->orderBy(RequestFacade::input('field'), RequestFacade::input('direction'));
                })
                ->paginate(10)->withQueryString(),
            'filters' => RequestFacade::only(['search', 'field', 'direction'])
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
