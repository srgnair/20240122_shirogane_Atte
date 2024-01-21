<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class LoginController extends Controller
{
    public function loginView()
    {
        return view('auth.login');
    }

    public function stampView()
    {
        $auths = auth::user();
        return view('stamp', ['auths' => $auths]);
    }

    public function registerForm()
    {
        return view('registerform');
    }

    public function registerConfirm(RegisterRequest $request)
    {
        $user = $request->only(['name', 'email', 'password', 'password_confirmation']);
        return view('auth.register', compact('user'));
    }

    public function register(RegisterRequest $request)
    {
        $validatedData = $request->validated();
        $hashedPassword = Hash::make($validatedData['password']);
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => $hashedPassword,
        ]);

        $user->sendEmailVerificationNotification();

        return redirect()->route('verifyEmail');
    }


        public function verifyEmail()
    {
        return view('auth.verify-email');
    }

    public function thanks()
    {
        return view('thanks');
    }

    public function destroy()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
