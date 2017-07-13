<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeliveryTime extends Model {
	
	protected $table = 'delivery_times';
	public $timestamps = true;

	/* Creating rules */
	public static $rules_create = array(
		'name'=>'required',
		'email'=>'required',
	);

	/* Updating rules */
	public static $rules_edit = array(
		'id'=>'required',
		'name'=>'required',
		'email'=>'required',
	);
	
    public function section() {
        return $this->belongsTo('Solunes\Master\App\Section');
    }
	
}