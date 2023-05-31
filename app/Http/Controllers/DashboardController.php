<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //
    public function aerosapace_total_box()
    {
        $data = DB::table('stocks')
            ->join('items', 'stocks.ItemsId', '=', 'items.uuid')
            ->select(DB::raw('SUM(stocks.Stock) as Total_Box'))->groupBy('items.UOM')->get();

        return response()->json($data);
    }
    public function aerosapace_total_barang()
    {
        $data = DB::table('stocks')
            ->join('items', 'stocks.ItemsId', '=', 'items.uuid')
            ->select(DB::raw('SUM(stocks.Stock) as Total_Box, items.Price, SUM(stocks.Stock) * items.Price as total_stok'))->where('items.UOM', 'BOX')->groupBy('items.UOM')->get();

        return response()->json($data);
    }
    public function chard_stock()
    {
        $data = DB::table('stocks')
            ->join('items', 'stocks.ItemsId', '=', 'items.uuid')
            ->select(DB::raw('SUM(stocks.Stock) as Total_Box, items.Price, SUM(stocks.Stock) * items.Price as total_stok, items.ItemName as Item_Name'))->groupBy('items.uuid')->get();

        return response()->json($data);
    }
}
