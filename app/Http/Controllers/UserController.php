<?php

namespace App\Http\Controllers;

use App\Exceptions\GeneralException;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Handle user login and authentication.
     * @method POST
     * @route /login
     */
    public function login(Request $request) {
        $validate = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(!$validate->fails()) {
            try {
                $user = User::where('email', $request->email)->first();

                if(!$user || !Hash::check($request->password, $user->password)) {
                    return response([
                        'message' => ['These credentials do not match our records.']
                    ], 404);
                }
        
                $token = $user->createToken('auth_token')->plainTextToken;
        
                $response = [
                    'user' => $user,
                    'token' => $token,
                ];
        
                return response($response, 201);
            } catch(\Exception $e) {
                throw new GeneralException($e->getMessage(), 400);
            }

        } else {
            return response($validate->errors(), 401); 
        }
    }
}
