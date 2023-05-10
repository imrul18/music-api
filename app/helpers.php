<?php

use App\Models\UserData;

if (!function_exists('message')) {
    function message($message = "Operation successful", $statusCode = 200, $data = [])
    {
        return response()->json(['message' => $message, 'data' => $data, 'status' => $statusCode], $statusCode);
    }
}

if (!function_exists('user')) {
    function user()
    {
        return auth()->user();
    }
}

if (!function_exists('userId')) {
    function userId()
    {
        return auth()->user()->id;
    }
}

if (!function_exists('companyId')) {
    function companyId()
    {
        return user()->company_id;
    }
}

if (!function_exists('access')) {
    function access($permission)
    {
        $userData = UserData::with('designation:id,name')->find(auth()->user()->id);
        $permissions = json_decode($userData->permission);
        $designation = $userData->designation->name;

        if ($designation == "Admin" || in_array($permission, $permissions)) {
            return true;
        } else {
            return false;
        }
    }
}

if (!function_exists('getPermission')) {
    function getPermission($user)
    {
        $permissions = UserData::find($user->id)->permission;
        return $permissions;
    }
}

if (!function_exists('checkPermission')) {
    function checkPermission($grantPermission)
    {
        $userData = UserData::with('designation:id,name')->find(auth()->user()->id);
        $permissions = json_decode($userData->permission);
        $designation = $userData->designation->name;
        foreach ($grantPermission as $item) {
            if ($designation == "Admin") {
                $permission["is" . ucfirst(explode("_", $item)[1])] = true;
            } else {
                $permission["is" . ucfirst(explode("_", $item)[1])] = in_array($item, $permissions);
            }
        }
        return $permission;
    }
}
