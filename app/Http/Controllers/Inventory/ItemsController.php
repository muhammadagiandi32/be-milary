<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Items;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use DataTables;

class ItemsController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth:api');
    }
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
        $data = User::get();

        return DataTables::of($data)->toJson();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $validator = Validator::make(request()->all(), [
            'item_name' => 'required',
            'size' => 'required',
            'price' => 'required|integer',
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
            $data =  Items::create([
                'uuid' => Str::uuid(),
                'ItemName' => $request->item_name,
                'Size' => $request->size,
                'Price' => $request->price
            ]);
            return response()->json(['metadata' => [
                'path' => '/inventory',
                'http_status_code' => 'Created',
                'timestamp' => now()->timestamp,
                'data' => $data
            ]], 201);
        } catch (QueryException $th) {
            //throw $th;
            return response()->json($th);
        }
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
