<?php

namespace App\Http\Controllers;

use App\Enum\AccountTypes;
use App\Helpers\Helpers;
use App\Models\User;
use App\Models\AccountModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{


    public function createAccount(Request $request): JsonResponse
    {
        $userRules = [
            'firstname' => 'required|string',
            'middlename' => 'nullable|string',
            'lastname' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'address' => 'nullable|string',
            'city' => 'nullable|string',
            'state' => 'nullable|string',
            'postal_code' => 'nullable|string',
            'country' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'phone_number' => 'nullable|string',
            'nin' => 'required|string|unique:users,nin',
            'bvn' => 'required|string|unique:users,bvn',
            'account_type' => 'required|string|in:savings,current',
        ];

        // Validate user data
        $userValidator = Validator::make($request->all(), $userRules);
        if ($userValidator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $userValidator->errors()->first()
            ]);
        }

        try {
            DB::beginTransaction();

            // Create the user
            $user = User::create($request->all());

            $accountNumber = Helpers::generateAccountNumber();

            // Create the account data
            $accountData = [
                'account_number' => $accountNumber,
                'user_id' => $user->id,
                'tier' => 1,
                'type' => $request->account_type ?? AccountTypes::NAIRA,
                'currency' => AccountTypes::NAIRA,
                'can_credit' => true,
                'can_debit' => true,
                'balance' => 10000.00,
                'status' => true,
                'additional_field' => json_encode([]),
            ];

            // Create the account
            $account = AccountModel::create($accountData);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Account created successfully',
                'user' => $user,
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

    /**
     * Restrict debit functionality for the specified account.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function restrictDebit(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'account_number' => 'required|exists:accounts,account_number',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ]);
        }

        $accountNumber = $request->input('account_number');

        $account = AccountModel::where('account_number', $accountNumber)->first();

        $account->can_debit = false;
        $account->save();

        return response()->json([
            'status' => true,
            'message' => 'Debit functionality restricted for the account'
        ]);
    }

    /**
     * Restrict credit functionality for the specified account.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function restrictCredit(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'account_number' => 'required|exists:accounts,account_number',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ]);
        }

        $accountNumber = $request->input('account_number');

        $account = AccountModel::where('account_number', $accountNumber)->first();

        $account->can_credit = false;
        $account->save();

        return response()->json([
            'status' => true,
            'message' => 'Credit functionality restricted for the account'
        ]);
    }

    public function restrictAccount(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'account_number' => 'required|exists:accounts,account_number',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ]);
        }

        $accountNumber = $request->input('account_number');

        $account = AccountModel::where('account_number', $accountNumber)->first();

        $account->can_debit = false;
        $account->can_credit = false;
        $account->status = false;
        $account->save();

        return response()->json([
            'status' => true,
            'message' => 'Restriction placed on this account.'
        ]);
    }

    public function unRestrictAccount(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'account_number' => 'required|exists:accounts,account_number',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ]);
        }

        $accountNumber = $request->input('account_number');

        $account = AccountModel::where('account_number', $accountNumber)->first();

        $account->can_debit = true;
        $account->can_credit = true;
        $account->status = true;
        $account->save();

        return response()->json([
            'status' => true,
            'message' => 'Restriction removed on this account.'
        ]);
    }

}
