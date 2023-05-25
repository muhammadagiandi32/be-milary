<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = DB::table('stocks')
            ->leftJoin('items', 'stocks.ItemsId', '=', 'items.uuid')
            ->select('stocks.Stock', 'items.ItemName', 'items.Size', 'items.Price')->get();

        return DataTables::of($data)->toJson();
    }
    /**
     * Show the form for creating a new resource.
     */
    public function search_items(Request $request)
    {
        //
        $data = DB::table('items')->where('ItemName', 'like', '%' . $request->search . '%')->limit(5)->get();
        $response = [];
        foreach ($data as $item) {
            $response[] = ['ItemName' => $item->ItemName];
        }
        return response()->json($response);
    }
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
