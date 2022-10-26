<?php

namespace App\Http\Controllers;

use App\Http\Traits\ApiResponse;
use App\Mail\SendPasswordMail;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    use ApiResponse;

    public function OTPGenerator($length_of_string)
    {
        return substr(bin2hex(random_bytes($length_of_string)), 0, $length_of_string);
    }

    public function sendPasswordToMail($email, $username, $password)
    {
        return Mail::to($email)->send(new SendPasswordMail($username, $password));
    }

    public function login(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'email' => ['string', 'min:3'],
            'password' => ['string', 'min:3'],
        ]);
        try {
            if (!Auth::attempt(['email' => $request->email, 'password' => $request->password, "active" => 1])){
                if (!Auth::attempt(['email' => $request->email, 'password' => $request->password, "active" => 1]))
                    return response()->json('Invalid login details', 500);
            }
            $token = $request->user()->createToken('auth_token')->plainTextToken;
            $user = $request->user();
            $user->email_verified_at = date('Y-m-d h:i:s');
            $user->save();
            return response()->json([
                'token' => $token,
                'token_type' => 'Bearer',
                'id' => Crypt::encrypt($request->user()->id),
                'user' => $request->user(),
            ]);
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }

    public function signUp(Request $request): \Illuminate\Http\JsonResponse
    {

        try{
            $request->validate([
                'name' => ['string', 'min:3', 'required'],
                'email' => ['email', 'required', 'unique:users,email'],
                'password' => ['string', 'min:4', 'required'],
            ], 
            ["email.unique" => "Sorry, this email has already been taken!"]);

                $user = new User();
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                $user->save();
                //$this->sendPasswordToMail($request->email, $request->username, $passwordGenerate);
                return response()->json(["status"=>1, "message"=>"You have successfully signed up...!!"]);

        } catch (\Exception $exception){
            return response()->json($exception->getMessage(), 500);
        }
    }

    

    public function logout(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $request->user()->tokens()->delete();
            return response()->json("User logout successfully.");
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }

    public function forgetPassword(Request $request)
    {
        $request->validate([
           "email" => ["required", "exists:users,email"]
        ]);
        try {
            $user = User::query()->where("email",$request->email)->first();
            $password =  $this->OTPGenerator(8);
            $user->password =  Hash::make($password);
            $user->save();
            $this->sendPasswordToMail($request->email, $user->username, $password);
            return $this->apiSuccess("Password has been send to provided email");
        } catch (Exception $exception){
            return $this->apiFailed("",[],$exception->getMessage());
        }
    }


}

