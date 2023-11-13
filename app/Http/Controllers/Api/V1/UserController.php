<?php

namespace App\Http\Controllers\Api\V1;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\UserResource;
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
                    return response()->json([
                        'message' => ['These credentials do not match our records.']
                    ], 404);
                }
        
                $token = $user->createToken('auth_token')->plainTextToken;
        
                $response = [
                    'user' => new UserResource($user),
                    'token' => $token,
                ];
        
                return response()->json($response, 201);
            } catch(\Exception $e) {
                throw new GeneralException($e->getMessage(), 400);
            }

        } else {
            return response()->json($validate->errors(), 401); 
        }
    }
}
