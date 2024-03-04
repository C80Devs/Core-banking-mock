<?php

namespace App\Http\Controllers;

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
        // Validation rules for user data
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
                'type' => 'savings', // Change to 'current' if desired
                'currency' => 'NGN',
                'can_credit' => true,
                'can_debit' => true,
                'balance' => 0.00,
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
}
