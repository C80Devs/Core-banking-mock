<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Models\AccountModel;
use App\Models\Transactions;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BalanceController extends Controller
{
    const  WITHDRAWAL_CHARGE = 100;

    public function debitAccount(Request $request): JsonResponse
    {
        $rules = [
            'account_number' => 'required|exists:account_models,account_number',
            'amount' => 'required|numeric|min:0',
        ];

        // Validate the request
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ]);
        }

        try {
            DB::beginTransaction();

            $account = AccountModel::where('account_number', $request->account_number)->first();

            if (!$account) {
                return response()->json([
                    'status' => false,
                    'message' => 'Account not found'
                ]);
            }

            if ($account->balance < $request->amount) {
                return response()->json([
                    'status' => false,
                    'message' => 'Insufficient balance'
                ]);
            }

            $account->balance -= $request->amount;
            $account->save();

            Transactions::create([
                'account_id' => $account->id,
                'type' => 'debit',
                'amount' => $request->amount,
                'platform' => 'bank',
                'reference' => Helpers::generateReferenceNumber(),
            ]);

            Transactions::create([
                'account_id' => $account->id,
                'type' => 'charge',
                'amount' => self::WITHDRAWAL_CHARGE,
                'platform' => 'bank',
                'reference' => Helpers::generateReferenceNumber(),

            ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Account debited successfully',
                'account' => $account
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    function creditAccount()
    {

    }
}
