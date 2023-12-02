<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\EmployeesResource;
use App\Models\Employees;
use Illuminate\Support\Facades\Validator;
use Throwable;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employees::join('company', 'company.id', '=', 'employees.company_id')
            ->select('employees.id', 'employees.first_nm', 'employees.last_nm', 'employees.company_id', 'company.name', 'employees.email', 'employees.phone', 'employees.created_at', 'employees.updated_at')
            ->get();
        return response()->json(
            [
                'status'    => true,
                'data' => $employees
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_nm'      => 'required',
            'last_nm'       => 'required',
            'company_id'    => 'required',
            'email'    => 'email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'    => false,
                'message'   => $validator->errors()
            ]);
        }

        $employees = Employees::create([
            'first_nm'      => $request->first_nm,
            'last_nm'       => $request->last_nm,
            'company_id'    => $request->company_id,
            'email'         => $request->email,
            'phone'         => $request->phone,
        ]);
        return response()->json(
            [
                'status'    => true,
                'message'   => 'Data added successfully',
                'data' => new EmployeesResource($employees),
            ]
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employees = Employees::join('company', 'company.id', '=', 'employees.company_id')
            ->select('employees.id', 'employees.first_nm', 'employees.last_nm', 'employees.company_id', 'company.name', 'employees.email', 'employees.phone', 'employees.created_at', 'employees.updated_at')
            ->find($id);

        if (is_null($employees)) {
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
                'data' => $employees,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'first_nm'      => 'required',
            'last_nm'       => 'required',
            'company_id'    => 'required',
            'email'         => 'email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'    => false,
                'message'   => $validator->errors()
            ]);
        }

        $employees = Employees::find($id);
        $employees->first_nm = $request->first_nm;
        $employees->last_nm = $request->last_nm;
        $employees->company_id = $request->company_id;
        $employees->email = $request->email;
        $employees->phone = $request->phone;
        $employees->save();

        return response()->json(
            [
                'status'    => true,
                'message'   => 'Data updated successfully',
                'data' => new EmployeesResource($employees),
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $employees = Employees::find($id);
            $employees->delete();
            return response()->json(
                [
                    'status'    => true,
                    'message'   => 'Data deleted successfully',
                ]
            );
        } catch (Throwable $e) {
            return response()->json(
                [
                    'status'    => false,
                    'message'   => 'Data not found',
                ]
            );
        }
    }
}
