<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\UrlGenerator;

use Validator;
use Asset;
use AdminList;
use AdminItem;
use PDF;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CustomAdminController extends Controller {

    protected $request;
    protected $url;

    public function __construct(UrlGenerator $url) {
      $this->middleware('auth');
      //$this->middleware('permission:dashboard');
      $this->prev = $url->previous();
      $this->module = 'custom-admin';
    }

    public function getIndex() {
        $array['activities'] = \App\Activity::with('node','user')->orderBy('created_at', 'DESC')->get()->take(20);
        $array['notifications'] = \Auth::user()->notifications->take(20);
        return view('list.dashboard', $array);
    }

    public function getListUser($type, $action, $status = 'normal') {
        if($type=='orientacion'){
            $role = \Solunes\Master\App\Role::where('name', 'estudiante')->first();
        } else {
            $role = \Solunes\Master\App\Role::where('name', $type)->first();
        }
        $array = ['type'=>$type, 'i'=>NULL, 'dt'=>'edit'];
        $items = \App\User::where('status', $status)->whereHas('role_user', function ($query) use($role) {
            $query->where('role_id', $role->id);
        });
        $array['filter_category'] = 'custom';
        $array = \Func::get_parent_filter_data($type, $array);
        if($type=='estudiante'){
            $category_id = 1;
        } else if($type=='docente'){
            $category_id = 2;
        } else if($type=='empresa'){
            $category_id = 3;
        } else if($type=='orientacion'){
            $category_id = 4;
        }
        $array['filter_category_id'] = $category_id;
        $url = request()->fullUrl();
        $array['url'] = $url;
        $array['parameters_array'] = [];
        if($action=='download'){
            $forms = [];
            $rejected_fields = ['filled_form_id', 'created_at', 'updated_at', 'deleted_at', 'id'];
            foreach($array['custom_options'] as $option_key => $option_value){
                $field_options = [];
                $form_node = \Solunes\Master\App\Node::where('name', $option_key)->first();
                foreach($form_node->fields()->where('display_list', '!=', 'none')->whereNotIn('name', $rejected_fields)->get() as $field){
                    $field_options[$field->name] = $field->label;
                }
                $forms[$option_key] = ['name'=>$option_value, 'field_options'=>$field_options];
            }
            $array['forms'] = $forms;
            foreach(request()->all() as $filter_key => $filter_input){
                $array['parameters_array'][$filter_key] = $filter_input;
            }
            $array['download_url'] = str_replace('/download', '/list-all', $url);
        } else {
            $array['download_url'] = str_replace('/list-all', '/download', $url);
        }
        $array = \AdminList::filter_node($array, \Solunes\Master\App\Node::where('name', 'user')->first(), '\App\User', $items, 'custom', 'filled_form_id');
        $items = $items->with('filled_forms');
        $array['items'] = $items->get();
        $array['action'] = $action;
        $array['status'] = $status;
        if($status!='normal'){
            $status_array = ['activate'=>'Activar usuarios'];
        } else {
            $status_array = ['inactivate'=>'Inactivar usuarios'];
        }
        $array['custom_assign_forms'] = $array['custom_assign_forms'] + $status_array ;
        if(request()->has('finish-download')){
            $fields = ['Nº'];
            $user_items = [];
            $excel_items = [];
            foreach($array['items'] as $item){
                $user_items[] = $item->id;
            }
            foreach($array['custom_options'] as $option_key => $option_value){
                $subfields = [];
                $subfields_codes = [];
                if(request()->has($option_key)){
                    $filled_form_ids = \App\FilledForm::where('model', $option_key)->whereIn('user_id', $user_items)->lists('model_id')->toArray();
                    $field_array = request()->input($option_key);
                    foreach($field_array as $field_name){
                        $subfields[] = $forms[$option_key]['field_options'][$field_name];
                        $subfields_codes[] = $field_name;
                    }
                    $node = \Solunes\Master\App\Node::where('name', $option_key)->first();
                    $node_model = \FuncNode::node_check_model($node);
                    $form_items = $node_model->get();
                    $node_fields = $node->fields()->whereIn('name', $subfields_codes)->get();
                    $fields = array_merge($fields, $subfields);
                    foreach($form_items as $item){
                        if($item->filled_form){
                            if(isset($excel_items[$item->filled_form->user_id])){
                                $excel_items[$item->filled_form->user_id] = array_merge($excel_items[$item->filled_form->user_id], AdminList::make_fields_values($item, $node_fields, '','excel'));
                            } else {
                                $excel_items[$item->filled_form->user_id] = AdminList::make_fields_values($item, $node_fields, '','excel');
                            }
                        }
                    }
                }
            }

            $dir = public_path('excel');
            array_map('unlink', glob($dir.'/*'));
            $file = \Excel::create('formularios-de-usuarios_'.date('Y-m-d'), function($excel) use($array, $fields, $excel_items) {
                $excel->getDefaultStyle()->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $excel->sheet('campos', function($sheet) use($array, $fields, $excel_items) {
                    $sheet->row(1, $fields);
                    $sheet->row(1, function($row) {
                      $row->setFontWeight('bold');
                    });

                    $fila = 2;
                    foreach($array['items'] as $item){
                      if(isset($excel_items[$item->id])){
                        $sheet->row($fila, array_merge([$fila-1], $excel_items[$item->id]));
                        $fila++;
                      }
                    }
                });
            })->store('xlsx', $dir, true);
            return response()->download($file['full']);
        } else {
            return view('list.user', $array);
        }
    }

    public function getListForm($user_id) {
        $array['user'] = \App\User::find($user_id);
        $array['items'] = \App\FilledForm::where('user_id', $user_id)->get();
        return view('list.form', $array);
    }

    public function postAssignForm(Request $request) {
        $id_array = $request->input('id');
        if(count($id_array)>0){
            $model = $request->input('model');
            if($model=='activate'||$model=='inactivate'){
                foreach(\App\User::whereIn('id', $id_array)->get() as $user){
                    if($model=='activate'){
                        $user->status = 'normal';
                    } else {
                        $user->status = 'banned';
                    }
                    $user->save();
                }
                return redirect($this->prev)->with('message_success', 'Se cambió el estado de '.count($id_array).' usuarios.');
            } else {
                $type = $request->input('type');
                if($type=='orientacion'){
                    $type = 'estudiante';
                }
                $node = \Solunes\Master\App\Node::where('name', $model)->first();
                foreach($id_array as $id){
                    $form = \FuncNode::node_check_model($node);
                    $filled_form = \Func::generate_form($model, $id, $type);
                    $form->filled_form_id = $filled_form->id;
                    $form->save();
                    $filled_form->model_id = $form->id;
                    $filled_form->save();
                }
                return redirect($this->prev)->with('message_success', 'El formulario fue asignado correctamente a '.count($id_array).' usuarios.');
            }
        } else {
            return redirect($this->prev)->with('message_error', 'Debe seleccionar al menos un usuario para asignarle un formulario.');
        }
    }

    public function getProject($id) {
        $array['project'] = \App\Project::find($id);
        return view('list.project', $array);
    }

    public function getRedirectUserForms() {
        $redirect = url('admin/list-form/'.auth()->user()->id);
        return redirect($redirect);
    }

    public function getFormList() {
        $node = \Solunes\Master\App\Node::where('name', 'node')->first();
        $array = ['module'=>'node', 'model'=>'node', 'langs'=>NULL, 'appends'=>NULL, 'action_fields'=>['create','edit']];
        $array['items'] = \Solunes\Master\App\Node::where('dynamic', 1)->whereNull('parent_id')->get();
        $array['fields'] = $node->fields()->where('display_list', 'show')->get();
        return view('list.dynamic-form', $array);
    }

    public function getFormFields($id) {
        $node = \Solunes\Master\App\Node::find($id);
        $array = ['node'=>$node, 'i'=>NULL, 'action'=>'create', 'dt'=>'editor'];
        $array['fields'] = $node->fields()->where('display_item', '!=', 'none')->with('translations','field_extras','field_options_active')->get();
        foreach($node->fields()->where('type', 'map')->get() as $field){
            $array['map_array'][$field->id] = $field;
        }
        if(count($array['fields'])==0){
            return redirect('admin/form-field/create/'.$id.'/filled_form_id');
        }
        return view('item.form-fields', $array);
    }

    public function getForm($action, $id = NULL) {
        $node = \Solunes\Master\App\Node::where('name','node')->first();
        $array = ['model'=>'node', 'node'=>$node, 'i'=>NULL, 'id'=>$id, 'dt'=>'form', 'action'=>$action];
        if($action=='edit'){
            $array['i'] = \Solunes\Master\App\Node::find($id);
        }
        $array['fields'] = $node->fields()->whereIn('name', ['name','permission','singular','plural'])->with('translations','field_extras','field_options_active')->get();
        return view('item.form', $array);
    }

    public function postForm(Request $request) {
        $action = $request->input('action');
        $rules = [
            'name'=>'required|alpha_dash',
            'permission'=>'required',
            'singular'=>'required',
            'plural'=>'required',
        ];
        $validator = \Validator::make($request->all(), $rules);
        if($validator->passes()) {
            $node_array = [];
            if($action=='create'){
                $node_name = \Dynamic::check_node_exists('form-'.str_replace('_', '-', $request->input('name')), 0);
                $node = \Dynamic::generate_node($node_name);
                $node_array['model'] = '\App\FormModel';
                $node_array['location'] = 'app';
                $node_array['type'] = 'normal';
                $node_array['folder'] = 'form';
                $node_array['permission'] = $request->input('permission');
                $node_array['dynamic'] = 1;
                \Dynamic::generate_node_table($table_name, ['id'=>'increments', 'filled_form_id'=>'integer', 'timestamps'=>'timestamps']);
            } else {
                $node = \Solunes\Master\App\Node::find($request->input('id'));
            }
            $node_array['additional_permission'] = $request->input('additional_permission');
            $node_array['singular'] = $request->input('singular');
            $node_array['plural'] = $request->input('plural');
            $node = \Dynamic::edit_node($node, $node_array);
            if($action=='create'){
                // Agregar a menu correspondiente
                $languages = \Solunes\Master\App\Language::get();
                $count = 0;
                if($menu_parent = \Solunes\Master\App\Menu::where('menu_type', 'admin')->where('level', 1)->where('permission', $node->permission)->first()){
                    $menu = \Solunes\Master\App\Menu::create(['menu_type'=>'admin', 'permission'=>$node->permission, 'parent_id'=>$menu_parent->id, 'level'=>2, 'icon'=>'th-list']);
                    $menu->translateOrNew('es')->name = $node->plural;
                    $menu->translateOrNew('es')->link = 'admin/model-list/'.$node->name;
                    $menu->save();
                }
                $columns = \Schema::getColumnListing($table_name);
                foreach($columns as $col){
                    $count = \FuncNode::node_field_creation($table_name, $node, $col, 0, $count, $languages);
                }
                $node->fields()->where('name', 'filled_form_id')->update(['display_item'=>'none']);
                // Agregar action buttons a nodo
                if($node->permission=='orientacion'){
                    $value_array = ["create","create_anonym","view"];
                } else {
                    $value_array = ["edit","delete"];
                }
                \Dynamic::generate_node_extra($node, 'action_field', $value_array);
            }
            return AdminItem::post_success($action, 'admin/form/edit/'.$node->id);
        } else {
            return AdminItem::post_fail($action, $this->prev, $validator);
        }
    }

    public function getFormField($action, $parent_id, $name = NULL) {
        $array = ['model'=>'field', 'pdf'=>false, 'dt'=>$action, 'action'=>$action];
        $field = \Solunes\Master\App\Field::where('parent_id', $parent_id)->where('name', $name)->first();
        $array['field'] = $field;
        if($action=='create'){
            $array['type_class'] = [];
            $array['cols'] = NULL;
            $array['i'] = NULL;
            $array['past_field'] = $field;
        } else {
            $array['type_class'] = ['disabled'=>1];
            if($col = $field->field_extras()->where('type', 'cols')->first()){
                $array['cols'] = $col->value;
            } else {
                $array['cols'] = NULL;
            }
            $array['i'] = $field;
            $array['past_field'] = NULL;
        }
        return view('item.form-field', $array);
    }

    public function postFormField(Request $request) {
        $action = $request->input('action');
        $rules = [
            'display_list'=>'required',
            'label'=>'required',
            'required'=>'required',
            'new_row'=>'required',
            'cols'=>'required',
        ];
        $validator = \Validator::make($request->all(), $rules);
        if($validator->passes()) {
            $field_array = [];
            $field_type = $request->input('type');
            if($action=='create'){
                $node = \Solunes\Master\App\Node::find($request->input('parent_id'));
                $last_field = \Solunes\Master\App\Field::find($request->input('field_id'));

                // Ajustar Orden
                $order = $last_field->order;
                $suborder = $order;
                foreach($node->fields()->where('order', '>', $order)->get() as $subfield){
                  $suborder++;
                  $subfield->order = $suborder+1;
                  $subfield->save();
                }

                // Ajustar ultimo campo en caso de que sea titulo o subtitulo
                if($last_field->type=='title'||$last_field->type=='content'||$last_field->type=='custom'){
                  $last_field = $node->fields()->where('order', '<=', $last_field->order)->whereNotIn('type', ['title','content','custom'])->orderBy('order', 'DESC')->orderBy('id', 'DESC')->first();
                }

                // Asignar un nombre al campo y verificar que no exista.
                $field_id = count($node->fields);
                $field_name = \Dynamic::check_field_exists($node, $node->table_name.'_field_'.$field_id);
                $field = \Dynamic::generate_field($node, $field_name, $field_type);
                $field_array = ['order'=>$order+1, 'trans_name'=>$field_name];
            } else {
                $field = \Solunes\Master\App\Field::find(request()->input('field_id'));
            }
            if($field_type=='title'||$field_type=='content'||$field_type=='custom'){
                $field_array['display_list'] = 'none';
                $field_array['required'] = 0;
            } else {
                $field_array['display_list'] = $request->input('display_list');
                $field_array['required'] = $request->input('required');
            }
            $field_array['label'] = $request->input('label');
            $field_array['tooltip'] = $request->input('tooltip');
            $field_array['message'] = $request->input('message');
            $field_array['new_row'] = $request->input('new_row');
            $field = \Dynamic::edit_field($field, $field_array);
            if($action=='create'){
                \Dynamic::generate_field_table($node, $field_type, $field_name, $last_field);
                // Image folder
                if($field_type=='image'){
                    $field_folder = \Dynamic::generate_field_extra($field, $node->name.'-'.$field_name, 'jpg');
                    \Dynamic::generate_image_size($field_folder, 'normal', 'resize', 600) ;
                }
                if($field_type=='image'||$field_type=='file'){
                    \Dynamic::generate_field_extra($field, 'folder', $node->name.'-'.$field_name) ;
                }
                // Datepicker class correction
                if($field_type=='date'){
                    \Dynamic::generate_field_extra($field, 'class', 'datepicker') ;
                }
            }
            // Cols extra class
            \Dynamic::generate_field_extra($field, 'cols', $request->input('cols')) ;
            // Agregar array de opciones
            \Dynamic::generate_field_options($request->input('options_id'), $field, $request->input('options_label'), $request->input('options_active'));
            return AdminItem::post_success($action, 'admin/form-field/edit/'.$request->input('parent_id').'/'.$field->name);
        } else {
            return AdminItem::post_fail($action, $this->prev, $validator);
        }
    }

    public function getExportForms() {
        $dir = public_path('excel');
        array_map('unlink', glob($dir.'/*'));
        $file = \Excel::create('dynamic-forms', function($excel) {
            $excel->getDefaultStyle()->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $nodes = \Solunes\Master\App\Node::where('dynamic', 1)->get();
            $nodes_array = [];
            $edits_array = [];
            $extras_array = [];
            $options_array = [];
            $field_node = \Solunes\Master\App\Node::where('name', 'field')->first();
            $fields = $field_node->fields()->whereIn('name', ['name','type','required'])->get();
            foreach($nodes as $node){
                $export_array[$node->name]['name'] = $node->name;
                $col_array = [];
                foreach($fields as $field){
                    array_push($col_array, $field->name);
                }
                array_push($col_array, 'cols');
                array_push($col_array, 'label_es');
                $export_array[$node->name]['columns'] = $col_array;
                array_push($nodes_array, [$node->name, $node->table_name, $node->type, $node->model, $node->folder, $node->permission, $node->singular, $node->plural]);
                foreach($node->fields as $item){
                  $row_array = [];
                  foreach($fields as $field){
                    $field_name = $field->name;
                    array_push($row_array, $item->$field_name);
                  }
                  // EDITS
                  if($field->display_list!='excel'){
                    array_push($edits_array, [$node->name, $item->name, 'display_list', $field->display_list]);
                  }
                  if($field->display_item!='show'){
                    array_push($edits_array, [$node->name, $item->name, 'display_item', $field->display_item]);
                  }
                  // EXTRAS
                  $cols = 6;
                  foreach($item->extras as $extra_key => $extra_val){
                    if($extra_key=='cols'){
                      $cols = $extra_val;
                    } 
                    if($extra_key!='cols'){
                      array_push($extras_array, [$node->name, $item->name, $extra_key, $extra_val]);
                    }
                  }
                  // Añadir col a campo
                  array_push($row_array, $cols);
                  // Añadir español label
                  array_push($row_array, $item->label);
                  $export_array[$node->name]['rows'][$item->id] = $row_array;
                  // OPCIONES
                  if(in_array($item->type, ['select','radio','checkbox'])&&count($item->options)>0){
                    foreach($item->options as $option_key => $option_val){
                      array_push($options_array, [$node->name, $item->name, $option_key, $option_val]);
                    }
                  }
                }
            }
            $excel->sheet('nodes', function($sheet) use ($nodes_array) {
                $sheet->row(1, ['name','table_name','type','model','folder','permission','singular_es','plural_es']);
                $sheet->row(1, function($row) {
                  $row->setFontWeight('bold');
                });
                $fila = 2;
                foreach($nodes_array as $node){
                  $sheet->row($fila, $node);
                  $fila++;
                }
            });
            $excel->sheet('edits', function($sheet) use ($edits_array) {
                $sheet->row(1, ['form','field','column','value']);
                $sheet->row(1, function($row) {
                  $row->setFontWeight('bold');
                });
                $fila = 2;
                foreach($edits_array as $edit){
                  $sheet->row($fila, $edit);
                  $fila++;
                }
            });
            $excel->sheet('extras', function($sheet) use ($extras_array) {
                $sheet->row(1, ['form','field','type','value']);
                $sheet->row(1, function($row) {
                  $row->setFontWeight('bold');
                });
                $fila = 2;
                foreach($extras_array as $extra){
                  $sheet->row($fila, $extra);
                  $fila++;
                }
            });
            $excel->sheet('options', function($sheet) use ($options_array) {
                $sheet->row(1, ['form','field','name','label_es']);
                $sheet->row(1, function($row) {
                  $row->setFontWeight('bold');
                });
                $fila = 2;
                foreach($options_array as $option){
                  $sheet->row($fila, $option);
                  $fila++;
                }
            });
            foreach($export_array as $export){
              $excel->sheet($export['name'], function($sheet) use($export) {
                $sheet->row(1, $export['columns']);
                $sheet->row(1, function($row) {
                  $row->setFontWeight('bold');
                });

                $fila = 2;
                foreach($export['rows'] as $row){
                  $sheet->row($fila, $row);
                  $fila++;
                }
              });
            }
        })->store('xlsx', $dir, true);
        return response()->download($file['full']);
    }

    public function getImportForms() {
        // Importar formularios dinámicos
        foreach(\Solunes\Master\App\Node::where('dynamic', 1)->orderBy('id','DESC')->get() as $node){
            \Schema::dropIfExists($node->table_name);  
        }
        // Crear formularios dinamicos de excel
        \Excel::load(public_path('seed/dynamic-forms.xlsx'), function($reader) {
            $options_array = [];
            $extras_array = [];
            $edits_array = [];
            $languages = \Solunes\Master\App\Language::get();
            foreach($reader->get() as $key => $sheet){
              $sheet_model = $sheet->getTitle();
              if($sheet_model=='nodes'){
                foreach($sheet as $row){
                    // Crear nodo y tabla inicial
                    $node = \Dynamic::generate_node($row->name, $row->table_name);
                    $node_array = ['type'=>$row->type, 'model'=>$row->model, 'dynamic'=>1, 'folder'=>$row->folder, 'permission'=>$row->permission, 'singular'=>$row->singular_es, 'plural'=>$row->plural_es];
                    $node = \Dynamic::edit_node($node, $node_array, 'es');
                    \Dynamic::generate_node_table($node->table_name, ['id'=>'increments']);
                    // Crear campos de tabla pre llenada
                    /*$columns = \Schema::getColumnListing($node->table_name);
                    $count = 0;
                    foreach($columns as $col){
                        $count = \FuncNode::node_field_creation($node->table_name, $node, $col, 0, $count, $languages);
                    }*/
                    // Crear node extra
                    $node_extra = \Dynamic::generate_node_extra($node, 'action_field', ['edit','delete']);
                }
              } else if($sheet_model=='options'||$sheet_model=='extras'||$sheet_model=='edits'){
                foreach($sheet as $row){
                  $row_name = $row->field;
                  //$row_name = $row->form.'_'.$row->field;
                  $row_subname = $row->name;
                  //$row_subname = $row_name.'_'.$row->name;

                  if($sheet_model=='options'){
                    $options_array[$row_name][$row_subname] = ['name'=>$row->name, 'label'=>$row->label_es, 'active'=>$row->active];
                  } else if($sheet_model=='extras'){
                    $extras_array[$row_name][$row_subname][$row->key] = $row->value;
                  } else if($sheet_model=='edits'){  
                    $edits_array[$row_name][$row_subname][$row->key] = $row->value;
                  }
                }
              } else {
                $node = \Dynamic::generate_node($sheet_model);
                $field_array = [];
                $last_field = NULL;
                foreach($sheet as $subkey => $row){
                    $row_name = $row->name;
                    $field = \Dynamic::generate_field($node, $row_name, $row->type);
                    $field_array = ['order'=>$subkey, 'label'=>$row->label_es, 'type'=>$row->type, 'trans_name'=>$row_name];
                    if($row->type=='title'||$row->type=='content'||$row->type=='custom'||$subkey>5){
                        $field_array['display_list'] = 'excel';
                    }
                    if($row->name=='id'||$row->name=='filled_form_id'){
                        $field_array['display_list'] = 'excel';
                        $field_array['display_item'] = 'none';
                        if($row->name=='filled_form_id'){
                            $field_array['value'] = 'filled_form';
                            $field_array['trans_name'] = 'filled_form';
                            $field_array['display_list'] = 'show';
                        }
                    }
                    $field = \Dynamic::edit_field($field, $field_array, 'es');
                    \Dynamic::generate_field_table($node, $field->type, $field->name, $last_field);
                    if(!in_array($row->type, ['title','content','custom','subchild','field'])){
                        $last_field = $field;
                    }
                    //if($row->cols!=3){
                    \Dynamic::generate_field_extra($field, 'cols', $row->cols);
                    //}

                    if($row->type=='select'||$row->type=='checkbox'||$row->type=='radio'){
                      \Dynamic::generate_field_options($options_array[$row_name], $field, 'es');
                    }
                }
              }
            }
        });
    }

}