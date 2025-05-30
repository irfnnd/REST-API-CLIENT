<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    protected $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function showLogin()
    {
        if (Session::has('api_token')) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        $credentials = $request->only('email', 'password');
        $response = $this->apiService->login($credentials);

        if (isset($response['success']) && $response['success'] && isset($response['token'])) {
            Session::put('api_token', $response['token']);
            Session::put('user', $response['user']);

            return redirect()->route('dashboard')->with('success', 'Login berhasil!');
        }

        return back()->withErrors(['email' => 'Email atau password salah'])->withInput();
    }

    public function logout()
    {
        Session::forget(['api_token', 'user']);
        return redirect()->route('login')->with('success', 'Logout berhasil!');
    }
}
