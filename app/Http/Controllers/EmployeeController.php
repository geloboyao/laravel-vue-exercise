<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller as Controller;

// models
use App\Models\Employee as Employee;

class EmployeeController extends Controller
{
    public function show()
    {
        $employees = Employee::get();

        $return = [];

        foreach ($employees as $employee) {
            $return[] = [
                'id' => $employee->id,
                'firstname' => $employee->firstname,
                'lastname' => $employee->lastname,
                'position' => $employee->position,
                'birth_date' => $employee->birth_date,
            ];
        }

        echo json_encode($return);
        exit;
    }

    public function store(Request $request)
    {
        $employee = new Employee;

        $employee->firstname  = trim($request->input('firstname'));
        $employee->lastname   = trim($request->input('lastname'));
        $employee->position   = trim($request->input('position'));
        $employee->birth_date = $request->input('birth_date');
        $employee->save();
    }

    public function update($id, Request $request)
    {
        $employee = Employee::findOrFail($id);

        $employee->firstname  = trim($request->input('firstname'));
        $employee->lastname   = trim($request->input('lastname'));
        $employee->position   = trim($request->input('position'));
        $employee->birth_date = trim($request->input('birth_date'));
        $employee->save();
    }

    public function destroy(Request $request)
    {
        Employee::findOrFail($request->id);
        Employee::destroy($request->id);
    }
}
