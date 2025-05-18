<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    public function store(Request $request)
    {

        $validated = Validator::make($request->all(), [
            'email' => 'required|string|email:rfc',
            'password' => 'required|string|min:8'
        ]);

        if ($validated->fails()) {
            return response()->json($validated->errors(), 403);

        }

        $credentials = ['email' => $request->email, 'password' => $request->password];

        try {

            if (!auth()->attempt($credentials)) {
                return response()->json(['error' => 'Email or password incorrect '], 400);
            }


            $user = User::where('email', $request->email)->firstOrFail();
            $token = $user->createToken('token')->plainTextToken;
            $user['token'] = $token;

            return response()->json([
                'data' => $user,
            ], 201);

        } catch (\Exception $exception) {
            return response()->json([
                'error' => [
                    $exception->getMessage()
                ]
            ], 500);
        }

    }

    public function destroy(Request $request)
    {
        try {
            $request->user()->currentAccessToken(null)->delete();

            return response()->json([
                'message' => "user has been logged out succesfully"
            ], 200);

        } catch (\Exception $th) {
            return response()->json([
                "error" => $th->getMessage(),
            ]);
        }

    }
}
