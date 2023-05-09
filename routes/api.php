<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\email\emailController;
use App\Http\Controllers\Inventory\ItemsController;
use App\Http\Controllers\Inventory\OrderController;
use App\Http\Middleware\AccessToken;
use App\Mail\IncomeMember;
use App\Models\Items;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Mail;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
    Route::post('register', [AuthController::class, 'register']);
    Route::get('verify/{id}', [AuthController::class, 'verifyUser']);

});

Route::post('inventory', [ItemsController::class, 'store'])->middleware([AccessToken::class]);
Route::post('inventory/order', [OrderController::class, 'store']);
Route::get('inventory/get-order', [OrderController::class, 'show']);

Route::post('notifications/emails', [emailController::class, 'store']);

Route::get('/test/paginate', function(){
    $data = User::paginate(10);
    return response()->json(['metadata' => [
        'path' => '/',
        'http_status_code' => 'OK',
        'timestamp' => now()->timestamp,
        'message'=>'Account already verified...',
        'data' => $data,
    ]], 200);
});

Route::get('test', function () {

    // Data Item Dari Database
    $item = Items::get();

    // looping item
    foreach ($item as $items) {
        // result untuk payload Items
        $result_items[] = [
            'name' => $items->ItemName,
            'size' => $items->Size,
            'qty'  => 1,
            'price' => intval($items->Price)
        ];

        // array untuk mendapatkan sie dan qty
        $size[] = [
            'size' => $items->Size,
            'qty'  => 1
        ];
    }

    // Merubah Multidimensional Array to String
    $str_size = [];
    foreach ($size as $sizes) {
        $str_size[] = implode(' ', $sizes);
    }

    // parameter untuk No Invoice
    $inv = 'INV000000003';
    $payload = [
        'consignee' => [
            'name' => 'edbert angriawan',
            'phone_number' => '6287812670688'
        ],
        'consigner' => [
            'name' => 'Aerospace',
            'phone_number' => '6281226608686'
        ],
        'courier' => [
            'cod' => false,
            'rate_id' => 1,
            'use_insurance' => true
        ],
        'external_id' => $inv,
        'coverage' => 'domestic',
        'origin' => [
            'address' => 'Jl. Kemandoran VIII No.14 RT.7/RW.3 Grogol Utara , Kebayoran Lama, Jakarta Selatan 12210, Indonesia',
            'area_id' => 12210,
            'lat' => '-6.210514502685641',
            'lng' => '106.78521108178155'
        ],
        'destination' => [
            'address' => 'Jalan Kaliurang km 12.5, Candi Karang, Sardonoharjo, Kec. Ngaglik, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55581',
            'area_id' => 55581,
            'lat' => '-6.210514502685641',
            'lng' => '106.78521108178155',
            // payload untuk direction (Catatan pada Resi). 
            // $inv Diambil dari parameter no Invoice.
            // fungsi implode digunakan untuk memisahkan Array menjadi ', '. $str_size diambil dari Multidimensional Array.
            'direction' => $inv . '. ' . implode(", ", $str_size)
        ],
        'package' => [
            'height' => 12,
            'items'  => $result_items,
            'length' => 12,
            'package_type' => 2,
            'price' => 678000,
            'weight' => 1,
            'width' => 12
        ],
        'payment_type' => 'postpay'
    ];
    // return $payload;

    $response = Http::withHeaders([
        'X-API-Key' => 'yQ0Od6uRNMBRZcPnOKDb1JXo4MVKPApTRhr0BD9eexP4yFLZ2EZ7SN5u8q0klO',
        'accept' => 'application/json'
    ])->withBody(json_encode($payload), 'application/json')->post('https://merchant-api.shipper.id/v3/order');
    return response()->json($response);
});
