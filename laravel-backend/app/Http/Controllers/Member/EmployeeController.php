<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Models\Department;
use App\Models\Employee;
use App\Models\EmploymentContracts;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function getEmployee()
    {
        $employees = Employee::with([
            'department:depart_id,depart_name',
            'role:role_id,role_name',
            'position:pos_id,pos_name',
            'employmentContract'
        ])->get();

        return response()->json($employees);
    }

    public function createEmployee(EmployeeRequest $request)
    {
        try {
            $user = User::create([
                'name' => $request->fullname,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            $user_id = $user->id;
            $department = Department::findOrFail($request->depart_id);
            $manager_id = $department->manager_id;
            Employee::create([
                'emp_code' => $request->emp_code,
                'fullname' => $request->fullname,
                'birthday' => $request->birthday,
                'sex' => $request->sex,
                'email' => $request->email,
                'phone' => $request->phone,
                'hire_date' => $request->hire_date,
                'status' => 1,
                'manager_id' => $manager_id,
                'depart_id' => $request->depart_id,
                'pos_id' => $request->pos_id,
                'role_id' => $request->role_id,
                'user_id' => $user_id,
            ]);
            $contract_code = "HD - " . $request->emp_code;
            EmploymentContracts::create([
                'user_id' => $user_id,
                'contract_code' => $contract_code,
                'sign_date' => $request->sign_date,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'basic_salary' => $request->luongCoBan,
                'insurance_salary' => $request->luongCoBan,
                'allowance' => $request->phuCap
            ]);
            return response()->json(['message' => 'Create Employee successfully'], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Lỗi',
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ], 422);
        }
    }
    public function updateEmployee(Request $request, $id)
    {
        $employee = Employee::find($id);
        if (!$employee) {
            return response()->json('message', 'Employee not found');
        }
        try {
            $userData = [
                'name'  => $request->fullname,
                'email' => $request->email,
            ];
            if ($request->filled('password')) {
                $userData['password'] = Hash::make($request->password);
            }

            User::findOrFail($employee->user_id)->update($userData);

            $department = Department::findOrFail($request->depart_id);
            $manager_id = $department->manager_id;
            $employee->update([
                'emp_code' => $request->emp_code,
                'fullname' => $request->fullname,
                'birthday' => $request->birthday,
                'sex' => $request->sex,
                'email' => $request->email,
                'phone' => $request->phone,
                'hire_date' => $request->hire_date,
                'status' => 1,
                'manager_id' => $manager_id,
                'depart_id' => $request->depart_id,
                'pos_id' => $request->pos_id,
                'role_id' => $request->role_id,
            ]);
            $employmentContract = EmploymentContracts::where('user_id', $employee->user_id)->first();

            if ($employmentContract) {
                $employmentContract->update([
                    'sign_date' => $request->sign_date,
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date,
                    'basic_salary' => $request->luongCoBan,
                    'insurance_salary' => $request->luongCoBan,
                    'allowance' => $request->phuCap,
                ]);
            }
            return response()->json(['message' => 'update Employee successfully'], 200);
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Lỗi', $e->getMessage()], 422);
        }
    }
    public function actionEmployee($id)
    {
        $employee = Employee::find($id);

        $employee->status =
            $employee->status == 1 ? 0 : 1;

        $employee->save();

        return response()->json([
            'message' => 'Success',
        ]);
    }
    public function deleteEmployee($id)
    {
        $employee = Employee::find($id);
        if (! $employee) {
            return response()->json(['message' => 'employee not found'], 404);
        }
        $employee->delete();

        return response()->json(['message' => 'Delete employee '], 200);
    }
}
