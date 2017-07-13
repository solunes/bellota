<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model {
	
	protected $table = 'ads';
	public $timestamps = true;

	/* Creating rules */
	public static $rules_create = array(
		'title'=>'required',
		'image'=>'required',
	);

	/* Updating rules */
	public static $rules_edit = array(
		'id'=>'required',
		'title'=>'required',
		'image'=>'required',
	);
	
    public function section() {
        return $this->belongsTo('Solunes\Master\App\Section');
    }
	
}