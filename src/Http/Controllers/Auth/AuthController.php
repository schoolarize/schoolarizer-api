<?php

namespace Schoolarize\Schoolarizer\Http\Controllers\Auth;


use Schoolarize\Schoolarizer\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
     /*
    |--------------------------------------------------------------------------
    | Auth Controller
    |--------------------------------------------------------------------------
    | This controller handles authenticating admins to the applications dashboard and
    | redirecting them to login screen if not logged in.
    |
    */

    public function login(Request $request)
    {
        $this->validateLogin($request);

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user(); 

            $success['token'] =  $user->createToken('token')-> accessToken; 
            return response()->json($success, 200); 
        }
        return response()->json(['error'=>'Unauthenticated Please check your email and password'], 401); 
    }



    public function logout(Request $request)
    {
        $success['message'] = "Successfully logged out.";
        $error = "Something went wrong.";

        $logout = $request->user()->token()->revoke();
        return ($logout) ? response()->json($success, 200) : response()->json(['error' => $error], 401);
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
    }


}
