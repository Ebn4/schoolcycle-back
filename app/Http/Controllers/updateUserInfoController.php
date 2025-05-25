<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class updateUserInfoController extends Controller
{
    public function update(Request $request)
    {
        $user = auth()->user();

        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        ]);

        // Update user information
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];


        $user->save();

        return response()->json(['message' => 'User information updated successfully.'], 200);
    }

    public function updatePassword(Request $request)
    {
        $user = auth()->user();

        // Validate the request data
        $validatedData = $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        // Check if the current password is correct
        if (!Hash::check($validatedData['current_password'], $user->password)) {
            return response()->json(['error' => 'Current password is incorrect.'], 403);
        }


        // Update the password
        $user->password = Hash::make($validatedData['new_password']);
        $user->save();

        return response()->json(['message' => 'Password updated successfully.'], 200);
    }
}
