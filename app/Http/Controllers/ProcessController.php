<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\UrlGenerator;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use AdminItem;

class ProcessController extends Controller {

	protected $request;
	protected $url;

	public function __construct(UrlGenerator $url) {
	  $this->prev = $url->previous();
	}

  public function getChangeLocale($locale) {
    \Session::put('locale', $locale);
    return redirect($this->prev);
  }


  public function postSubscribe(Request $request) {
    if($request->has('email')&&$request->has('name')){
      if(!$user = \App\User::where('email', $request->input('email'))->first()){
        $user = new \App\User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = '12345678';
        $user->save();
      }

      if(!$newsletter = \App\Newsletter::where('email', $request->input('email'))->first()){
        $newsletter = new \App\Newsletter;
        $newsletter->name = $request->input('name');
        $newsletter->email = $request->input('email');
        $newsletter->save();
      }

      if (\Auth::attempt(['email'=>$user->email, 'password'=>'12345678'], true)) {
        return redirect($this->prev)->with('message_success', 'Felicidades, se suscribió correctamente a nuestro sistema.');
      } else {
        return redirect($this->prev)->with('message_success', 'Felicidades, se suscribió correctamente a nuestro sistema.');
      }
    } else {
      return redirect($this->prev)->with('message_error', 'Debe llenar ambos campos para hacer posible su registro.');
    }
  }

  public function postSaveModel(Request $request) {
      $model = $request->input('model_node');
      $action = $request->input('action');
      $lang_code = $request->input('lang_code');
      $node = \Solunes\Master\App\Node::where('name', $model)->first();
      // Medidads de seguridad
      if($model!='postulation-a'&&$model!='postulation-b'){
        return redirect($this->prev)->with(['message_error'=>'Hubo un error al procesar el formulario.']);
      } else if($node->deadline&&$node->deadline->deadline<date('Y-m-d')){
        return redirect($this->prev)->with(['message_error'=>$node->deadline->expired_message]);
      } else if(!\Auth::check()&&($model=='postulation-a'||$model=='postulation-b')){
        return redirect($this->prev)->with(['message_error'=>'Hubo un error de autenticación.']);
      } else if($model=='postulation-a'||$model=='postulation-b'){
        if($model=='postulation-a'&&!\Auth::user()->registry_a()->whereHas('postulation_a', function ($query) {
          $query->where('id', request()->input('id'));
          $query->where('status', 'holding');
        })->first()){
          return redirect($this->prev)->with(['message_error'=>'Hubo un error en el llenado del formulario.']);
        } else if($model=='postulation-b'&&!\Auth::user()->registry_b()->whereHas('postulation_b', function ($query) {
          $query->where('id', request()->input('id'));
          $query->where('status', 'holding');
        })->first()){
          return redirect($this->prev)->with(['message_error'=>'Hubo un error en el llenado del formulario.']);
        }
      }
      $response = AdminItem::post_request($model, $action, $request);
      $item = $response[1];
      $item = AdminItem::post_request_success($request, $model, $item, 'process');
      return redirect($this->prev)->with('message_success', 'Su formulario fue guardado correctamente. Sin embargo, aún no fue enviado para participar en el concurso.');
  }

	public function postModel(Request $request) {
      $model = $request->input('model_node');
      $lang_code = $request->input('lang_code');
      $node = \Solunes\Master\App\Node::where('name', $model)->first();
      //$action = $request->input('action');
      // Medidads de seguridad
      if($model=='postulation-a'||$model=='postulation-b'){
        $action = 'edit';
      } else {
        $action = 'send';
      }
      if($node->folder!='form'){
        return redirect($this->prev)->with(['message_error'=>'Hubo un error al procesar el formulario.']);
      } else if($node->deadline&&$node->deadline->deadline<date('Y-m-d')){
        return redirect($this->prev)->with(['message_error'=>$node->deadline->expired_message]);
      } else if(!\Auth::check()&&($model=='postulation-a'||$model=='postulation-b')){
        return redirect($this->prev)->with(['message_error'=>'Hubo un error de autenticación.']);
      } else if($model=='postulation-a'||$model=='postulation-b'){
        if($model=='postulation-a'&&!\Auth::user()->registry_a()->whereHas('postulation_a', function ($query) {
          $query->where('id', request()->input('id'));
          $query->where('status', 'holding');
        })->first()){
          return redirect($this->prev)->with(['message_error'=>'Hubo un error en el llenado del formulario.']);
        } else if($model=='postulation-b'&&!\Auth::user()->registry_b()->whereHas('postulation_b', function ($query) {
          $query->where('id', request()->input('id'));
          $query->where('status', 'holding');
        })->first()){
          return redirect($this->prev)->with(['message_error'=>'Hubo un error en el llenado del formulario.']);
        }
      }
      $response = AdminItem::post_request($model, $action, $request);
      $item = $response[1];
      $redirect = $this->prev;
      if($response[0]->passes()) {
        $item = AdminItem::post_request_success($request, $model, $item, 'process');

        if($model=='registry-a'||$model=='registry-b'){
          
          $test_passed = true;
          $password = rand(100000,999999);
          if($user = \App\User::where('email', $request->input('contact_email'))->first()){
            $user_exists = true;
          } else {
            $user_exists = false;
            $user = new \App\User;
            $user->name = $request->input('contact_name');
            $user->email = $request->input('contact_email');
            $user->password = $password;
            $user->status = 'ask_password';
            $user->save();
            $member = \Solunes\Master\App\Role::where('name', 'member')->first();
            $user->role_user()->sync([$member->id]);
          }

          $item->user_id = $user->id;
          $item->status = 'approved';
          $item->save();

          if($model=='registry-a'){
            $pos = new \App\PostulationA;
            $pos->registry_a_id = $item->id;
          } else {
            $pos = new \App\PostulationB;
            $pos->registry_b_id = $item->id;
          }
          $pos->save();

          $vars = ['@name@'=>$user->name, '@email@'=>$user->email, '@password@'=>$password];
          if($model=='registry-a'){
            $vars['@postulation_link@'] = '<a href="'.url('postulacion-a?postulation_a='.$pos->id).'" target="_blank">'.url('postulacion-a?postulation_a='.$pos->id).'</a>';
          } else {
            $vars['@postulation_link@'] = '<a href="'.url('postulacion-b?postulation_b='.$pos->id).'" target="_blank">'.url('postulacion-b?postulation_b='.$pos->id).'</a>';
          }
          $if_vars['if:user_exists'] = false;
          $if_vars['if:user_dont_exists'] = false;
          if($user_exists){
            $if_vars['if:user_exists'] = true;
          } else {
            $if_vars['if:user_dont_exists'] = true;
          }
          \FuncNode::make_email('registry_approved', [$user->email], $vars, $if_vars);
        } else if($model=='postulation-a'||$model=='postulation-b'){
          $item->status = 'sent';
          $item->send_date = date('Y-m-d');
          if($model=='postulation-a'&&$item->total_ponderation>=80){
            $item->status = 'approved';
            // CREAR CORREO A APROBADO?
          }
          $item->save();
          $redirect = 'postulaciones';
          // CREAR CORREO A USUARIO? A ADMIN?
        } else if($model=='form-contact'){
          $vars = ['@name@'=>$item->name, '@email@'=>$item->email, '@phone@'=>$item->phone, '@address@'=>$item->address, '@message@'=>$item->message];
          \FuncNode::make_email('contact_form', [\FuncNode::check_var('admin_email')], $vars);
        }

  		  return redirect($redirect)->with('message_success', trans('ajax.'.$model.'_success'));
  	  } else {
  		  return redirect($redirect)->with(array('message_error' => trans('ajax.'.$model.'_fail')))->withErrors($response[0])->withInput();
  	  }
	}

}