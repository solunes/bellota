<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subbanner extends Model {
	
	protected $table = 'subbanners';
	public $timestamps = true;

	/* Creating rules */
	public static $rules_create = array(
		'name'=>'required',
		'image'=>'required',
	);

	/* Updating rules */
	public static $rules_edit = array(
		'id'=>'required',
		'name'=>'required',
		'image'=>'required',
	);
	
    public function section() {
        return $this->belongsTo('Solunes\Master\App\Section');
    }
	
}