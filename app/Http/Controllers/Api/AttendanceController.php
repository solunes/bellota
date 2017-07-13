<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller\Api;
use App\OperatorAttendance;

class AttendanceController extends BaseController {

	public function registerAttendance(Request $request){
        if($request->input('ci')&&$request->input('sucursal')&&$operator = \App\Operator::where('ci',$request->input('ci'))->first()){
            $response = \Func::register_attendance($operator, $request->input('sucursal'));
            return $this->response->array(['operator_created'=>false, 'upload_image'=>$response['upload_image'], 'id'=>$response['id'], 'name'=>$operator->name, 'type'=>$response['type'], 'attendance_time'=>$response['attendance_time']])->setStatusCode(200);
        } else if($request->input('ci')&&$request->input('name')&&$request->input('sucursal')&&$customer_point = \App\CustomerPoint::find($request->input('sucursal'))) {
            $operator = \App\Operator::create(array(
                'city_id' => $customer_point->city_id,
                'ci' => $request->input('ci'),
                'name' => $request->input('name'),
            ));
            $response = \Func::register_attendance($operator, $request->input('sucursal'));
            return $this->response->array(['operator_created'=>true, 'upload_image'=>$response['upload_image'], 'id'=>$response['id'], 'name'=>$operator->name, 'type'=>$response['type'], 'attendance_time'=>$response['attendance_time']])->setStatusCode(200);
        } else if($request->input('ci')&&$request->input('sucursal')) {
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException('Operario no encontrado.');
        } else {
            throw new \Symfony\Component\HttpKernel\Exception\NotAcceptableHttpException('No proporcionó un CI o sucursal.');
        } 
	}

    public function checkCiExists(Request $request){
        if($request->input('ci')){
            if(\App\Operator::where('ci',$request->input('ci'))->count()>0){
                return $this->response->array(['exists'=>true])->setStatusCode(200);
            } else {
                return $this->response->array(['exists'=>false])->setStatusCode(200);
            }
        } else {
            throw new \Symfony\Component\HttpKernel\Exception\NotAcceptableHttpException('Debe enviar un CI.');
        }
    }

    public function uploadImage(Request $request){
        if($request->hasFile('file')&&$request->input('id')&&$attendance = \App\OperatorAttendance::find($request->input('id'))){
            if($request->input('rotate')){
                $rotate = $request->input('rotate');
            } else {
                $rotate = 0;
            }
            $picture = \Asset::upload_image($request->file('file'), 'attendance', false, $rotate);
            if($picture){
                $attendance->picture = $picture;
                $attendance->save();
                return $this->response->array(['uploaded'=>true, 'imageurl'=>\Asset::get_image_path('attendance', 'thumb', $picture)])->setStatusCode(200);
            } else {
                throw new \Symfony\Component\HttpKernel\Exception\NotAcceptableHttpException('Hubo un error al subir la foto.');
            }
        } else if($request->hasFile('file')&&$request->input('id')) {
            throw new \Symfony\Component\HttpKernel\Exception\NotAcceptableHttpException('Debe enviar ID que exista.');
        } else {
            throw new \Symfony\Component\HttpKernel\Exception\NotAcceptableHttpException('Debe enviar un archivo e ID.');
        }
    }


}
