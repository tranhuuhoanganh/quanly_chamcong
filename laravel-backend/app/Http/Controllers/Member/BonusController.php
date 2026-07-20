<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Bonus;
use App\Models\BonusType;
use App\Models\User;
use Illuminate\Http\Request;

class BonusController extends Controller
{
    public function getBonus()
    {
        $Bonuss = Bonus::with([
            'bonusType',
            'user'
        ])->get();
        return response()->json($Bonuss);
    }
    public function getType()
    {
        return response()->json(BonusType::all());
    }
    public function createBonus(Request $request)
    {
        try {
            $User = User::find($request->user_id);

            Bonus::create([
                'user_id' => $User->id,
                'bonus_type_id' => $request->bonus_type_id,
                'amount' => $request->amount,
                'payroll_month' => $request->payroll_month,                
                'reason' => $request->reason,
            ]);
            return response()->json(['message' => 'create successfully.'], 200);
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Bonus not created', 'error' => $e->getMessage()], 422);
        }
    }
    public function editBonus(Request $request, $id)
    {
        $Bonus = Bonus::find($id);
        try {
            $Bonus->update([
                'bonus_type_id' => $request->bonus_type_id,
                'amount' => $request->amount,
                'payroll_month' => $request->payroll_month,
                'reason' => $request->reason,
            ]);
            return response()->json(['message' => 'edit successfully.'], 200);
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Bonus not edit', 'error' => $e->getMessage()], 422);
        }
    }
    public function deleteBonus($id)
    {
        $bonus = Bonus::find($id);
        if (!$bonus) {
            return response()->json(['message' => 'Bonus not found'], 404);
        }
        $bonus->delete();
        return response()->json(['message' => 'Delete Department '], 200);
    }
}
