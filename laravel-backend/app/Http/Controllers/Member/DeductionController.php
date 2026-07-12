<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Deduction;
use App\Models\DeductionType;
use App\Models\Employee;
use Illuminate\Http\Request;

class DeductionController extends Controller
{
    public function getDeduction()
    {
        $deductions = Deduction::with([
            'deductionType',
            'user'
        ])->get();
        return response()->json($deductions);
    }
    public function getType()
    {
        return response()->json(DeductionType::all());
    }
    public function createDeduction(Request $request){
        try {
            $Employee = Employee::find($request->user_id);
            Deduction::create([
                'user_id' => $Employee->user_id,
                'deduction_type_id' => $request->deduction_type_id,
                'amount' => $request->amount,
                'deduction_date' => $request->deduction_date,
                'reason' => $request->reason,
            ]);
            return response()->json(['message'=>'create successfully.'],200);
        } catch (\Throwable $e) {
            return response()->json(['message'=>'Deduction not created', 'error'=> $e->getMessage()],422);
        }
    }
    public function editDeduction(Request $request,$id){
        $deductions = Deduction::find($id);
         try {
            $deductions->update([
                'user_id' => $request->user_id,
                'deduction_type_id' => $request->deduction_type_id,
                'amount' => $request->amount,
                'deduction_date' => $request->deduction_date,
                'reason' => $request->reason,
            ]);
            return response()->json(['message'=>'edit successfully.'],200);
        } catch (\Throwable $e) {
            return response()->json(['message'=>'Deduction not edit', 'error'=> $e->getMessage()],422);
        }
    }
}
