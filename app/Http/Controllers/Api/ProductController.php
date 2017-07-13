<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller\Api;
use App\Product;

class ProductController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(){
		return Product::get();
	}
	
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
	public function show($id){
		return Product::findOrFail($id);
	}

}
