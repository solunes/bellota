<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class Blog extends Model {
	
	protected $table = 'blogs';
	public $timestamps = true;

    use Sluggable, SluggableScopeHelpers;
    public function sluggable(){
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    
	/* Creating rules */
	public static $rules_create = array(
		'name'=>'required',
		'tag'=>'required',
		'summary'=>'required',
		'content'=>'required',
		'image'=>'required',
	);

	/* Updating rules */
	public static $rules_edit = array(
		'id'=>'required',
		'name'=>'required',
		'tag'=>'required',
		'summary'=>'required',
		'content'=>'required',
		'image'=>'required',
	);
	
}