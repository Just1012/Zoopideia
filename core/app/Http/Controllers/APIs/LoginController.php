<?php

namespace App\Http\Controllers\APIs;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Validate input
        $validator = Validator::make($request->all(), [
            'identifier' => 'required|string', // Can be email, phone number, or username
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ]);
        }

        $validatedData = $validator->valid();

        // Determine if the identifier is an email, phone number, or username
        if (filter_var($validatedData['identifier'], FILTER_VALIDATE_EMAIL)) {
            $fieldType = 'email';
        } elseif (preg_match('/^\d{10,15}$/', $validatedData['identifier'])) {
            $fieldType = 'phone_number'; // Assuming phone number is only digits and 10-15 characters long
        } else {
            $fieldType = 'userName';
        }

        // Attempt to find the user by the determined field type
        $user = User::where($fieldType, $validatedData['identifier'])->first();

        // Check if the user exists and the password is correct
        if (!$user || !Hash::check($validatedData['password'], $user->password)) {
            return response()->json([
                'status' => 401,
                'message' => 'Invalid credentials'
            ]);
        }

        // Generate an auth token
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => 200,
            'message' => 'Login successful',
            'token' => $token,
            'data' => $user
        ]);
    }
}
