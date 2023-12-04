<?php
use Illuminate\Support\Facades\Auth;
function message($status = true, $data = [], $message = '', $code = 200)
{
    return response()->json([
        'status' => $status,
        'data' => $data ?? [],
        'message' => $message,
        'code' => $code,
    ], $code);
}

function user()
{
   if(Auth::guard('api')->check()){
        return Auth::guard('api')->user();
    }
}