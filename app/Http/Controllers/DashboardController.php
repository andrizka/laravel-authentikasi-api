<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $access_token = session('access_token');
        $company = Http::withToken($access_token)->get(url('api/company'))->getBody()->getContents();
        $employees = Http::withToken($access_token)->get(url('api/employees'))->getBody()->getContents();
        $data = [
            'title' => 'Dashboard',
            'company'   => json_decode($company)->data,
            'employees'   => json_decode($employees)->data,

        ];
        return view('admin.dashboard.index', $data);
    }
}
