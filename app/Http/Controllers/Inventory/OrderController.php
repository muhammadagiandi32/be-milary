<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Items;
use App\Models\Order;
use App\Models\Stock;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $validator = Validator::make(request()->all(), [
            'item_id' => 'required',
            'qty' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['metadata' => [
                'path' => '/inventory',
                'http_status_code' => 'Bad Request',
                'errors' => $validator->messages(),
                'timestamp' => now()->timestamp
            ]], 400);
        }

        try {
            $item = Items::whereIn('uuid', $request->item_id)->get();
            $uuid = Str::uuid();
            for ($i = 0; $i < count($item); $i++) {
                $data[] = [
                    'uuid' => $uuid,
                    'ItemsId' => $request->item_id[$i],
                    'Qty' => $request->qty[$i],
                ];
                $check_stock = DB::table('stocks')
                    ->where('ItemsId', $request->item_id[$i])
                    ->first();
                return $check_stock;
                if ($check_stock->Stock < $request->qty[$i]) {
                    return response()->json(['metadata' => [
                        'path' => '/inventory',
                        'http_status_code' => 'Bad Request',
                        'errors' => 'Insufficient Stock',
                        'timestamp' => now()->timestamp
                    ]], 400);
                }
            }
            Order::insert($data);
            foreach ($data as $data_items) {
                Stock::where('ItemsId', $data_items['ItemsId'])->decrement('Stock', $data_items['Qty']);
            }
            return response()->json([
                'metadata' => [
                    'path' => '/inventory',
                    'http_status_code' => 'Created',
                    'timestamp' => now()->timestamp,
                    'order_id' => $uuid,
                    'data' => $data
                ],
                'message' => 'Order Has Ben Created'
            ], 201);
        } catch (QueryException $th) {
            return response()->json(['metadata' => [
                'path' => '/inventory',
                'http_status_code' => 'Bad Request',
                'errors' => 'Insufficient Stock',
                'timestamp' => now()->timestamp
            ]], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
        $data_order = DB::table('orders')->select('*', 'orders.uuid as uuid')
            ->leftJoin('items', 'orders.ItemsId', '=', 'items.uuid')
            ->get();
        // return $data_order;

        foreach ($data_order as $data) {
            $result[] =  [
                // 'DetailsItems' => [
                'ItemsId' => $data->ItemsId,
                'ItemName' => $data->ItemName,
                'Qty' => $data->Qty,
                'Size' => $data->Size,
                'Price' => $data->Price
                // ]
            ];
        }
        return response()->json([
            'metadata' => [
                'path' => '/inventory',
                'http_status_code' => 'OK',
                'timestamp' => now()->timestamp,
                'order_id' => $data_order[0]->uuid,
                'data' => $result
            ]
        ], 200);
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
