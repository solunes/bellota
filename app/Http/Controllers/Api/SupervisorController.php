<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller\Api;
use App\SupervisorAttendance;

class SupervisorController extends BaseController {
    
    public function __construct(){
        $this->middleware('jwt.auth');
    }

	public function registerCheckpoint(Request $request){
        $user = \JWTAuth::parseToken()->authenticate();
        if($request->input('sucursal')&&$request->input('piso')&&\Auth::check()){
            $user_id = \Auth::User()->id;
            SupervisorAttendance::create(array(
                'user_id' => $user_id,
                'point_id' => $request->input('sucursal'),
                'floor_id' => $request->input('piso'),
            ));
            return response()->json(compact('user'));
        } else {
            throw new \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException('No se pudo autentificar su cuenta.');
        }    
	}

}
