<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\IncomingStock;
use App\Models\Items;
use App\Models\Stock;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

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
    public function incoming_stocks(Request $request)
    {
        //
        // return response()->json($request);
        $validator = Validator::make(request()->all(), [
            'uuid' => 'required',
            'qty' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'metadata' => [
                    'path' => '/inventory',
                    'http_status_code' => 'Bad Request',
                    'errors' => $validator->messages(),
                    'timestamp' => now()->timestamp
                ],
                'errors' => $validator->messages(),
            ], 400);
        }

        // DB::enableQueryLog(); // Enable query log

        // Your Eloquent query executed by using get()

        // Show results of log
        try {
            DB::beginTransaction();
            /* SQL operation n */
            $items = Items::where('uuid', $request->uuid)->first();
            $stock = Stock::where('ItemsId', $request->uuid)->first();
            $total_price = $items->Price * $request->qty;
            // $check_stock = Stock::where('ItemsId', $request->uuid)->where('Stock', '<', $request->qty)->exists();

            $incoming_stocks = IncomingStock::create([
                'uuid' => Str::uuid(),
                'ItemsId' => $items->uuid,
                'StockId' => $stock->uuid,
                'total' => $request->qty,
                'Price' => $total_price,
                'created_at' => now()
            ]);

            Stock::where('ItemsId', $items->uuid)->increment('Stock', $incoming_stocks->total);
            // dd($incoming_stocks);
            // if ($check_stock === true) {
            //     DB::rollback();
            // }
            DB::commit();
            return response()->json(['metadata' => [
                'path' => '/inventory',
                'http_status_code' => 'Created',
                'timestamp' => now()->timestamp,
                'data' => $incoming_stocks
            ]], 201);
            /* Transaction successful. */
        } catch (Exception  $e) {
            DB::rollback();
            /* Transaction failed. */
            return response()->json($e);
        }
    }
    /**
     * Show the form for creating a new resource.
     */
    public function search_items(Request $request)
    {
        //
        $search = $request->search;
        if ($search == '') {
            $data = DB::table('items')->limit(5)->get();
        } else {
            $data = DB::table('items')->where('ItemName', 'like', '%' . $request->search . '%')->limit(5)->get();
        }
        $response = [];
        foreach ($data as $item) {
            $response[] = ['ItemName' => $item->ItemName, 'uuid' => $item->uuid];
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
