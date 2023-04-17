<?php

namespace App\Http\Controllers\email;

use App\Http\Controllers\Controller;
use App\Mail\IncomeMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class emailController extends Controller
{
    //
    public function store(Request $request)
    {
        // return response()->json($result);
        foreach ($request->data as $data) {
            // $data;
            $result[] = [
                'email' => $data['email'],
                'name' => $data['name'],
                'total_bonus' => $data['total_bonus']
            ];
            Mail::to($data['email'])->send(new IncomeMember($data['name'], $data['total_bonus']));
        }
        //code...
        return response()->json([
            'metadata' => [
                'path' => '/notifications',
                'http_status_code' => 'OK',
                'timestamp' => now()->timestamp,
                'data' => $result
            ],
            'message' => 'Email successfully sent'
        ], 200);
    }
}
