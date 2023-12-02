<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Throwable;
use App\Models\Company;
use App\Http\Resources\CompanyResource;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\TryCatch;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = Company::orderBy('id', 'desc')->get();
            return response()->json(
                [
                    'status'    => true,
                    'data' => CompanyResource::collection($data),
                ]
            );
        } catch (Throwable $e) {
            return response()->json(
                [
                    'status'    => false,
                    'message' => 'No data',
                ]
            );
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'  => 'required',
            'email' => 'email'
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'status'    => false,
                    'message'   => $validator->errors()
                ]
            );
        }

        $company = Company::create([
            'name'  => $request->name,
            'address'  => $request->address,
            'email'  => $request->email,
        ]);
        return response()->json(
            [
                'status'    => true,
                'message'   => 'Data added successfully',
                'data' => new CompanyResource($company),
            ]
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $company = Company::find($id);
        if (is_null($company)) {
            return response()->json(
                [
                    'status'    => false,
                    'message'    => 'Data not found',
                ],
                404
            );
        }
        return response()->json(
            [
                'status'    => true,
                'data' => new CompanyResource($company),
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name'  => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $company = Company::find($id);
        $company->name = $request->name;
        $company->email = $request->email;
        $company->address = $request->address;
        $company->save();

        return response()->json(
            [
                'status'    => true,
                'message'   => 'Data updated successfully',
                'data' => new CompanyResource($company),
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $company = Company::find($id);
        $company->delete();
        return response()->json(
            [
                'status'    => true,
                'message'   => 'Data deleted successfully',
            ]
        );
    }
}
