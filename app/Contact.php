<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model {
	
	protected $table = 'contacts';
	public $timestamps = true;
    
	/* Creating rules */
	public static $rules_create = array(
		'name'=>'required',
		'text'=>'required',
		'email'=>'required',
		'phone'=>'required',
		'address'=>'required',
		'latitude'=>'required',
		'longitude'=>'required',
	);

	/* Updating rules */
	public static $rules_edit = array(
		'id'=>'required',
		'name'=>'required',
		'text'=>'required',
		'email'=>'required',
		'phone'=>'required',
		'address'=>'required',
		'latitude'=>'required',
		'longitude'=>'required',
	);
	
}