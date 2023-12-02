<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $access_token = session('access_token');
            $request = Http::withToken($access_token)->get(url('api/company'))->getBody()->getContents();
            $response = json_decode($request);

            $company = $response->data;
            return datatables()->of($company)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btnShow = '<a href="' . route('company.show', ['company' => $row->id]) . '"  class="btn btn-warning me-2"><i class="bx bx-bullseye"></i></a>';
                    $btnEdit = '<a href="' . route('company.edit', ['company' => $row->id]) . '"  class="btn btn-success me-2"><i class="bx bx-edit"></i></a>';
                    $btnDestroy = '
                    <form action="' . route('company.destroy', ['company' => $row->id]) . '" method="post"> 
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
            'title'     => 'Company'
        ];
        return view('admin.company.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title'     => 'Company'
        ];
        return view('admin.company.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $access_token = session('access_token');
        $request = Http::withToken($access_token)->post(url('api/company'), [
            'name'  => $request->name,
            'address'  => $request->address,
            'email'  => $request->email,
        ])->getBody()->getContents();
        $response = json_decode($request);


        if ($response->status == true) {
            return redirect(route('company.index'))->with('message', $response->message);
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
        $request = Http::withToken($access_token)->get(url('api/company/' . $id))->getBody()->getContents();
        $response = json_decode($request);

        $data = [
            'title'     => 'Company',
            'company'   => $response->data,
        ];
        return view('admin.company.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $access_token = session('access_token');
        $request = Http::withToken($access_token)->get(url('api/company/' . $id))->getBody()->getContents();
        $response = json_decode($request);


        $data = [
            'title'     => 'Company',
            'company'   => $response->data,
        ];
        return view('admin.company.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $access_token = session('access_token');
        $request = Http::withToken($access_token)->put(url('api/company/' . $id), [
            'name'  => $request->name,
            'address'  => $request->address,
            'email'  => $request->email,
        ])->getBody()->getContents();
        $response = json_decode($request);

        if ($response->status == true) {
            return redirect(route('company.index'))->with('message', $response->message);
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
        $request = Http::withToken($access_token)->delete(url('api/company/' . $id))->getBody()->getContents();
        $response = json_decode($request);

        if ($response->status == true) {
            return redirect(route('company.index'))->with('message', $response->message);
        } else {
            return redirect()->back()->withErrors($response->message)->withInput();
        }
    }
}
