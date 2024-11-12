<?php

namespace App\Http\Controllers\APIs;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Config;
use Auth;
use Helper;

class ProfileController extends Controller
{
    private $uploadPath = "uploads/users/";
    public function userProfile($id)
    {
        $user = User::find($id);

        // Check if the user exists
        if (!$user) {
            return response()->json([
                'status' => 404,
                'message' => 'User Not Found',
            ], 404);
        }

        // Check if the authenticated user has permission to access this profile
        if (auth()->id() !== $user->id) {
            return response()->json([
                'status' => 403,
                'message' => 'You do not have permission to access this data',
            ], 403);
        }

        // Return the user data if both checks pass
        return response()->json([
            'status' => 200,
            'message' => 'User data fetched successfully',
            'data' => $user
        ], 200);
    }

    public function updateProfile(Request $request)
    {
        // Validate request
        $this->validate($request, [
            'first_name' => 'nullable|string',
            'last_name' => 'nullable|string',
            'email' => 'nullable|email|unique:users,email,' . Auth::user()->id,
            'phone_number' => 'nullable|string|unique:users,phone_number,' . Auth::user()->id,
            'image' => 'nullable|image',
        ], [
            'email.email' => 'Please provide a valid email address.',
            'email.unique' => 'This email is already in use by another user.',
            'phone_number.string' => 'The phone number must be a valid string.',
            'phone_number.unique' => 'This phone number is already in use by another user.',
            'image.image' => 'The image must be a valid image file.',
        ]);

        // Find the authenticated user
        $user = User::findOrFail(Auth::user()->id);

        // Update only the provided fields
        if ($request->filled('first_name') || $request->filled('last_name')) {
            $user->name = trim($request->first_name . ' ' . $request->last_name);
        }
        if ($request->filled('email')) {
            $user->email = $request->email;
        }
        if ($request->filled('phone_number')) {
            $user->phone_number = $request->phone_number;
        }

        // Handle image upload if provided
        if ($request->hasFile('image')) {
            $formFileName = "image";
            $fileFinalName = time() . rand(1111, 9999) . '.' . $request->file($formFileName)->getClientOriginalExtension();
            $path = $this->getUploadPath();
            $request->file($formFileName)->move($path, $fileFinalName);

            // Resize & optimize the image
            Helper::imageResize($path . $fileFinalName);
            Helper::imageOptimize($path . $fileFinalName);

            // Set the user's image
            $user->photo = $fileFinalName;
        }

        // Save the updated user information
        $user->save();
        return response()->json([
            'status' => 200,
            'message' => 'Profile Updated successfully',
            'data' => $user
        ]);
    }

    public function getUploadPath()
    {
        return $this->uploadPath;
    }

    public function setUploadPath($uploadPath)
    {
        $this->uploadPath = Config::get('app.APP_URL') . $uploadPath;
    }
}
