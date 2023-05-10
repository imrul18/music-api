<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function adminLogin(Request $request)
    {
        $user = User::where('username', $request->username)->where('type', 'admin')->first();
        if (!$user)
            return response()->json(['message' => 'No account found!!!', 'status' => 203], 203);

        if (!Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Password not matched!!!', 'status' => 203], 203);
        }
        if ($user->status == 'deactive') {
            return response()->json(['message' => 'User account deactivated!!!', 'status' => 203], 203);
        }
        $user->_token = $user->createToken('Token Name')->plainTextToken;

        $data = [
            'userData' => $user,
            'accessToken' => $user->_token,
            'refreshToken' => $user->_token,
        ];
        return response()->json($data, 200);
    }

    public function subscriberLogin(Request $request)
    {
        $user = User::where('username', $request->username)->where('type', 'subscriber')->first();
        if (!$user)
            return response()->json(['message' => 'No account found!!!', 'status' => 203], 203);

        if (!Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Password not matched!!!', 'status' => 203], 203);
        }
        if ($user->status == 'deactive') {
            return response()->json(['message' => 'User account deactivated!!!', 'status' => 203], 203);
        }
        $user->_token = $user->createToken('Token Name')->plainTextToken;

        $data = [
            'userData' => $user,
            'accessToken' => $user->_token,
            'refreshToken' => $user->_token,
        ];
        return response()->json($data, 200);
    }
}
