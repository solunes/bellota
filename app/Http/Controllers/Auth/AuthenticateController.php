<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;


class AuthenticateController extends Controller {
  
    public function authenticate(Request $request) {
        $credentials = $request->only('email', 'password');
        try {
            // verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Su usuario y contraseña no coinciden.'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong
            return response()->json(['error' => 'Hubo un error, vuelva a intentarlo.'], 500);
        }
        $date = date('d/n/Y H:i:s', strtotime('+6 months'));
        // if no errors are encountered we can return a JWT
        return response()->json(['token'=>$token, 'expirationDate'=>$date], 200);
    }
}