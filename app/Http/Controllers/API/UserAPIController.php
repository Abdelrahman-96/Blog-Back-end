<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Auth\ThrottlesAttempts;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAPIController extends Controller
{
    use ThrottlesAttempts;

    public function login(Request $request){
        if($this->hasTooManyAttempts($request))
        {
            return $this->sendLockoutResponse($request);
        }
        $credentials = ['email'=> $request->email , 'password' => $request->password];
        if (!Auth::attempt($credentials)) {
            $this->incrementAttempts($request);
            return message(false, [],'Unauthorized', 401);
        }
        if(Auth::attempt($credentials)){
            try{
                $apiToken = Auth::user()->createToken('blog')->accessToken;
            }catch(Exception $e){
                return message(false, [],$e->getMessage());
            }
            $user = new UserResource(Auth::user());
            $this->clearAttempts($request);
            return message(true, ["api_token" => $apiToken, 'user' => $user], 'Login successfully');
        }else{
            return message(false, [],'This user doesn\'t exist!');
        }
    }
}
