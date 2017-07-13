<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model {
	
	protected $table = 'newsletters';
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