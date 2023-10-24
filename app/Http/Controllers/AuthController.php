<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthLoginRequest;
use App\Http\Requests\AuthRegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function doRegister(AuthRegisterRequest $request)
    {
        // if(User::where('phone_number', $request->phone_number)->exists()) {
        //     return back()->with('errHP', 'Nomor HP yang Anda masukkan sudah terpakai');
        // }
        // elseif(User::where('email', $request->email)->exists()) {
        //     return back()->with('errEmail', 'Email yang Anda masukkan sudah terpakai');
        // }
        
        $user = User::create([
            'name' => $request->name,
			'email' => $request->email,
			'phone_number' => $request->phone_number,
			'password' => Hash::make($request->password),
			'role' => 'User'
		]);
        
        Auth::login($user);

        return redirect('/')->with('regSuccess', 'Selamat Datang di Website GOR Purwawidjaya!');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function doLogin(AuthLoginRequest $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed')
            ]);
        }

        $request->session()->regenerate();

        if (Auth::user()->name == 'admin') {
			return redirect('admin/dashboard')->with('message', 'Selamat Datang di Admin Panel');
		} else {
			return redirect('/')->with('message', 'Selamat Datang di Website GOR Purwawidjaya!');
		}
    }

    public function logout(Request $request)
	{
        Session::flush();
		Auth::logout();

		return redirect('/');
	}
}
