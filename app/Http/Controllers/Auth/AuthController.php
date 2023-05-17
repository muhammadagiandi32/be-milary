<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Mail\IncomeMember;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register','verifyUser']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        // if (!$token = auth()->attempt($credentials)) {
        //     return response()->json(['error' => 'Unauthorized'], 401);
        // }

        // return $this->respondWithToken($token);

        $credentials['is_verified'] = 1;
        
        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['success' => false, 'error' => 'We cant find an account with this credentials. Please make sure you entered the right information and you have verified your email address.'], 404);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['success' => false, 'error' => 'Failed to login, please try again.'], 500);
        }
        return $this->respondWithToken($token);

    }
    public function register(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['metadata' => [
                'path' => '/auth/register',
                'http_status_code' => 'Bad Request',
                'errors' => $validator->messages(),
                'timestamp' => now()->timestamp
            ]], 400);
        }

        try {
            $data = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            $verification_code = Str::random(30); //Generate verification code
            DB::table('user_verifications')->insert(['user_id'=>$data->id,'token'=>$verification_code]);
            $email= $request->email;
            $name= $request->name;
            $subject = "Please verify your email address.";
            Mail::send('emails.verify', ['name' => $name, 'verification_code' => $verification_code],
                function($mail) use ($email, $name, $subject){
                    $mail->from(env('MAIL_FROM_ADDRESS'), "From User/Company Name Goes Here");
                    $mail->to($email, $name);
                    $mail->subject($subject);
                });

            return response()->json(['metadata' => [
                'path' => '/auth/register',
                'http_status_code' => 'Created',
                'timestamp' => now()->timestamp,
                'data' => $data,
                'message'=>'Thanks for signing up! Please check your email to complete your registration.'
            ]], 201);
        } catch (QueryException $th) {
            //throw $th;
            return response()->json($th);
        }
    }

    // Verify email Users
    public function verifyUser($verification_code){
        $check = DB::table('user_verifications')->where('token',$verification_code)->first();

        if(!is_null($check)){
            $user = User::find($check->user_id);

            if($user->is_verified == 1){

                return response()->json(['metadata' => [
                    'path' => '/auth/register',
                    'http_status_code' => 'OK',
                    'timestamp' => now()->timestamp,
                    // 'data' => $data,
                    'message'=>'Account already verified...'
                ]], 200);
            }

            $user->update(['is_verified' => 1]);
            DB::table('user_verifications')->where('token',$verification_code)->delete();

            return response()->json(['metadata' => [
                'path' => '/auth',
                'http_status_code' => 'OK',
                'timestamp' => now()->timestamp,
                // 'data' => $data,
                'message'=>'You have successfully verified your email address.'
            ]], 200);
        }
        return response()->json([
            'metadata' => [
                'path' => '/auth/register',
                'http_status_code' => 'Unauthorized',
                'errors' => [
                    'code' => 401,
                    'message' => 'Verification code is invalid..'
                ],
                'timestamp' => now()->timestamp
            ]
        ],401);
    }
    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }
    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out'], 200);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
