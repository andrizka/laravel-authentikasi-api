<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $access_token = session('access_token');
            $request = Http::withToken($access_token)->get(url('api/employees'))->getBody()->getContents();
            $response = json_decode($request);

            $employees = $response->data;
            return datatables()->of($employees)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btnShow = '<a href="' . route('employees.show', ['employee' => $row->id]) . '"  class="btn btn-warning me-2"><i class="bx bx-bullseye"></i></a>';
                    $btnEdit = '<a href="' . route('employees.edit', ['employee' => $row->id]) . '"  class="btn btn-success me-2"><i class="bx bx-edit"></i></a>';
                    $btnDestroy = '
                    <form action="' . route('employees.destroy', ['employee' => $row->id]) . '" method="post"> 
                    <input type="hidden" name="_method" value="delete">
                    <input type="hidden" name="_token" value="' . csrf_token() . '" autocomplete="off">
                    <button type="submit" class="btn btn-danger me-2" onclick="return confirm(`Are you sure you want to delete this item?`);"><i class="bx bx-trash"></i></button>
                    </form>';
                    $btn = '<div class="d-flex">' . $btnShow . $btnEdit . $btnDestroy . '</div>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }


        $data = [
            'title'     => 'Employees'
        ];
        return view('admin.employees.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $access_token = session('access_token');
        $request = Http::withToken($access_token)->get(url('api/company'))->getBody()->getContents();
        $company = json_decode($request);
        $data = [
            'title'     => 'Employees',
            'company'   => $company->data,
        ];
        return view('admin.employees.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $access_token = session('access_token');
        $request = Http::withToken($access_token)->post(url('api/employees'), [
            'first_nm'  => $request->first_nm,
            'last_nm'  => $request->last_nm,
            'email'  => $request->email,
            'phone'  => $request->phone,
            'company_id'  => $request->company_id,
        ])->getBody()->getContents();
        $response = json_decode($request);

        if ($response->status == true) {
            return redirect(route('employees.index'))->with('message', $response->message);
        } else {
            return redirect()->back()->withErrors($response->message)->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $access_token = session('access_token');
        $request = Http::withToken($access_token)->get(url('api/employees/' . $id))->getBody()->getContents();
        $response = json_decode($request);

        $data = [
            'title'     => 'Employees',
            'employee'   => $response->data,
        ];
        return view('admin.employees.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $access_token = session('access_token');
        $company = Http::withToken($access_token)->get(url('api/company'))->getBody()->getContents();
        $employee = Http::withToken($access_token)->get(url('api/employees/' . $id))->getBody()->getContents();

        $data = [
            'title'     => 'Employees',
            'company'   => json_decode($company)->data,
            'employee'   => json_decode($employee)->data,
        ];
        return view('admin.employees.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $access_token = session('access_token');
        $request = Http::withToken($access_token)->put(url('api/employees/' . $id), [
            'first_nm'  => $request->first_nm,
            'last_nm'  => $request->last_nm,
            'email'  => $request->email,
            'phone'  => $request->phone,
            'company_id'  => $request->company_id,
        ])->getBody()->getContents();
        $response = json_decode($request);

        if ($response->status == true) {
            return redirect(route('employees.index'))->with('message', $response->message);
        } else {
            return redirect()->back()->withErrors($response->message)->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $access_token = session('access_token');
        $request = Http::withToken($access_token)->delete(url('api/employees/' . $id))->getBody()->getContents();
        $response = json_decode($request);

        if ($response->status == true) {
            return redirect(route('employees.index'))->with('message', $response->message);
        } else {
            return redirect()->back()->withErrors($response->message)->withInput();
        }
    }
}
