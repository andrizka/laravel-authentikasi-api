<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function Login()
    {
        $session = session('email');
        if ($session !== null) {
            return redirect(route('dashboard.index'));
        } else {
            return view('auth.login');
        }
    }

    public function login_auth(Request $request)
    {
        $request = Http::post(url('api/login'), [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ])->getBody()->getContents();
        $response = json_decode($request);
        if ($response->status == true) {
            session([
                'email' => $response->data->email,
                'access_token' => $response->access_token,
            ]);
            return redirect(route('dashboard.index'))->withInput();
        } else {
            session()->flash('message', $response->message);
            return redirect()->back()->withInput();
        }
    }

    public function logout()
    {
        $access_token = session('access_token');
        $request = Http::withToken($access_token)->post(url('api/logout'))->getBody()->getContents();
        $response = json_decode($request);
        if ($response->status == true) {
            session()->flush();
            return redirect(url('login'));
        }
    }
}
