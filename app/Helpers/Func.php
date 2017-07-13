<?php 

namespace App\Helpers;

use Facebook\Facebook;

class Func {

    public static function generate_form($model, $user_id, $type) {
        $filled_form = new \App\FilledForm;
        $filled_form->model = $model;
        if(\Auth::check()){
            $filled_form->filled_user_id = \Auth::user()->id;
        } else {
            $filled_form->filled_user_id = $user_id;
        }
        $filled_form->name = \App\User::find($user_id)->name.' - '.date('Y-m-d');
        $filled_form->user_id = $user_id;
        $filled_form->type = $type;
        $filled_form->save();
        return $filled_form;
    }

    public static function generate_qr_pdf($file, $code, $title, $subtitle, $action = 'save', $size = 400, $encode = true) {
        $qr = \Func::generate_qr($code, $size, $encode);
        $pdf = \PDF::loadView('pdf.qr', ['qr'=>$qr, 'title'=>$title, 'subtitle'=>$subtitle]);
        $pdf_response = $pdf->setPaper('letter')->$action($file.'.pdf');
        if($action=='save'){
          $file_name = \Asset::upload_file($file.'.pdf', 'qr');
          unlink($file.'.pdf');
          return $file_name;
        }
        return $pdf_response;
    }

    public static function generate_qr($code, $size = 400, $encode = true) {
        if($encode==true){
            $code = base64_encode($code);
        }
        return \QrCode::format('png')->size($size)->backgroundColor(255,255,255)->color(0,0,0)->generate($code);
    }

    public static function generate_auth_code($model) {
        $random_string = str_random(40);
        if($model::where('auth_code', $random_string)->count()==0){
            return $random_string;
        } else {
            return \Func::generate_auth_code($model);
        }
    }

    public static function menu_link($item, $level) {
        if($item->url()==NULL) {
            if($item->hasChildren()&&$level==1) {
                $link_attributes = 'class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"';
            } else {
                $link_attributes = NULL; 
            }
            $link = '<a '.$link_attributes.'>';
        } else if($item->url()=='') {
            $link = '<a '.$item->attributes().' href="#">';
        } else {
            $link = '<a '.$item->attributes().' href="'.$item->url().'">';
        }
        return $link.$item->title.'</a>';
    }

    public static function facebook_page_query($query, $page = NULL) {
        if($page==NULL){
            $page = \Config::get('services.facebook.page');
        }
        $fb = new Facebook([
          'app_id' => \Config::get('services.facebook.id'),
          'app_secret' => \Config::get('services.facebook.secret'),
          'default_graph_version' => 'v2.4',
          'default_access_token' => isset($_SESSION['facebook_access_token']) ? $_SESSION['facebook_access_token'] : \Config::get('services.facebook.id').'|'.\Config::get('services.facebook.secret')
        ]);
        $result = $fb->get('/'.$query);
        return $result->getGraphObject()->asArray();
    }

    public static function new_row($key, $columns) {
        if(is_int(($key+1)/$columns)){
            return '</div><div class="row">';
        } else {
            return false;
        }
    }

    public static function short_string($string, $lenght) {
    	if(strlen($string)>$lenght){
    	   $string = substr($string,0,$lenght-2).'..';
    	}
		return $string;
    }

    public static function share_link($social_network, $link) {
    	$link = str_replace(' ','%20',$link);
    	if($social_network=='facebook'){
    	    $url = 'https://www.facebook.com/sharer/sharer.php?u='.$link;
    	} else if($social_network=='twitter'){
    		$url = 'https://twitter.com/home?status='.$link;
    	}
		return $url;
    }

}