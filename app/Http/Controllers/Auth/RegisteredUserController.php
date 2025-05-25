<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'phone' => ['required', 'string', 'max:10', 'unique:'.User::class],
            'job' => ['required', 'string', 'max:255'],
            'avatar' => ['nullable', 'image', 'max:2048'], // Optional avatar field
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'job' => $request->job,
            'avatar' => $request->file('avatar') ? $request->file('avatar')->store('avatars', 'public') : null, // Store avatar if provided
            'password' => Hash::make($request->string('password')),
        ]);

        $user['token'] = $user->createToken('token')->plainText();

        event(new Registered($user));

        Auth::login($user);

        return response()->json([
            'data' => $user
        ]);
    }
}
