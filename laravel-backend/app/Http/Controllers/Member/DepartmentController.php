<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateDepartmentRequest;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function createDepartment(CreateDepartmentRequest $request)
    {
        try {
            $department = Department::create([
                'depart_code' => $request->depart_code,
                'depart_name' => $request->depart_name,
                'depart_description'=> $request->depart_description,
                'manager_id' => $request->manager_id,
                'status'=> '1'
            ]);
            return response()->json(['department'=>$department,'message'=>'create successfully.'],200);
        } catch (\Throwable $e) {
            return response()->json(['message'=>'Department not created', 'error'=> $e->getMessage()],422);
        }
    }
    public function getDepartment()
    {
        $departments = Department::with('manager:id,fullname')
            ->select('depart_id', 'depart_code', 'depart_name', 'depart_description', 'manager_id', 'status')
            ->get();

        return response()->json(['department' => $departments]);
    }

    public function updateDepartment(Request $request, $id)
    {
        $Department = Department::find($id);
        if (! $Department) {
            return response()->json(['message' => 'Department not found'], 404);
        }
        $Department->update([
            'depart_code' => $request->depart_code,
            'depart_name' => $request->depart_name,
            'depart_description' => $request->depart_description,
            'manager_id' => $request->manager_id,
        ]);

        return response()->json(['message' => 'Update Department '], 200);
    }

    public function deleteDepartment($id)
    {
        $Department = Department::find($id);
        if (! $Department) {
            return response()->json(['message' => 'Department not found'], 404);
        }
        $Department->delete();

        return response()->json(['message' => 'Delete Department '], 200);
    }

    public function actionDepartment($id)
    {
        $department = Department::find($id);

        $department->status =
            $department->status == 1 ? 0 : 1;

        $department->save();

        return response()->json([
            'message' => 'Success',
        ]);
    }
}
