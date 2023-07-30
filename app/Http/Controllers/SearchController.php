<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Spatie\Searchable\Search;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function search(Request $request)
    {
        $data = (new Search())
                    ->registerModel(Menu::class, 'name')
                    ->search($request->search);

        return response()->json($data);
    }
}
