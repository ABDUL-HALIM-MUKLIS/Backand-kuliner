<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //validate the request login
        $credentias = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if(auth()->attempt($credentias)){
            $user = auth()->user();
            $token = $user->createToken('api-kuliner')->plainTextToken;
            return response()->json([
                'token' => $token,
                'user' => new UserResource($user)
            ]);
        }

        return response()->json([
            'message' => 'Invalid credentials'
        ], 401);

    }
}
