<?php

namespace App\Http\Controllers;

use App\Enum\ChargeTypes;
use App\Helpers\Helpers;
use App\Models\AccountModel;
use App\Models\Transactions;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BalanceController extends Controller
{
    private  const  WITHDRAWAL_CHARGE = 100;


    public function debitAccount(Request $request): JsonResponse
    {
        $rules = [
            'account_number' => 'required|exists:accounts,account_number',
            'amount' => 'required|numeric|min:0',
        ];

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

          $debitTrx=  Transactions::create([
                'account_id' => $account->id,
                'type' => ChargeTypes::WITHDRAWAL,
                'amount' => $request->amount,
                'platform' => 'online',
                'description' => 'Account debited ' . $request->amount . config('app.currency'),
                'reference' => Helpers::generateReferenceNumber(),
            ]);

            Transactions::create([
                'account_id' => $account->id,
                'type' => ChargeTypes::CHARGE,
                'amount' => self::WITHDRAWAL_CHARGE,
                'platform' => 'online',
                'description' => "Charge for debit {$debitTrx->reference} on amount " . $request->amount . config('app.currency'),
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

    public function creditAccount(Request $request): JsonResponse
    {
        $rules = [
            'account_number' => 'required|exists:accounts,account_number',
            'amount' => 'required|numeric|min:0',
        ];

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

            // Increase the account balance
            $account->balance += $request->amount;
            $account->save();

            // Create transaction records
            Transactions::create([
                'account_id' => $account->id,
                'type' => ChargeTypes::DEPOSIT,
                'amount' => $request->amount,
                'description' => 'Account credited with ' . $request->amount . config('app.currency'),
                'platform' => 'online',
                'reference' => Helpers::generateReferenceNumber(),
            ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Account credited successfully',
                'account' => $account
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => false,
                'message' => 'Failed to credit account: ' . $e->getMessage()
            ]);
        }
    }

}
