<?php 

namespace App\Helpers;

use Form;

class CustomFunc {

    public static function get_custom_node_array($array, $page, $admin = false) {
        $subarray = [];
        switch ($page->customized_name) {
            case 'home':
                $subarray['content'] = \App\Content::getCode('home')->content;
                $subarray['banners'] = \App\Banner::get();
                $subarray['subbanners'] = \App\Subbanner::get();
                $subarray['product_offer'] = \Solunes\Store\App\Product::has('product_offer')->get()->random(3);
                $product_array = [];
                $product_array = \DB::table('cart_items')->select('product_id', \DB::raw('count(*) as total'))->groupBy('product_id')->orderBy('total','desc')->limit(3)->lists('product_id');
                if(count($product_array)<3){
                    $diff = 3 - count($product_array) + 1;
                    $product_array = array_merge($product_array, range(1, $diff));
                }
                $subarray['product_trending'] = \Solunes\Store\App\Product::whereIn('id', $product_array)->get();
                $subarray['product_new'] = \Solunes\Store\App\Product::orderBy('created_at','DESC')->limit(3)->get();
            break;
            case 'store':
                $subarray['products'] = \Solunes\Store\App\Product::get()->random(8);
            break;
        }
        $array['nodes'] = $subarray;
        return $array;
    }

    public static function get_node_array($array, $page, $admin = false) {
        $subarray = [];
        $array_node_names = [];
        $array_nodes = [];
        switch ($page->customized_name) {
            case 'offers': $array_nodes = ['offers'=>'content'];                   
            break;
            case 'how-to': $array_nodes = ['how-to'=>'content'];                   
            break;
            case 'about': $array_nodes = ['about'=>'content'];          
            break;
            case 'contact': $array_nodes = ['contact'=>'content', 'contact-form'];                   
            break;
        }
        $subarray = [];
        foreach($array_nodes as $node_val => $node_name){
            $node = \Solunes\Master\App\Node::where('name', $node_name)->first();
            $nodes[$node_name] = $node;
            $subarray = \FuncNode::get_items_array($node, $node_val);
            $array['nodes'][$node_name] = ['node'=>$node, 'subarray'=>$subarray];
        }
        $array = \CustomFunc::get_scripts_array($array, $nodes);
        return $array;
    }

    public static function get_scripts_array($array, $nodes) {
        $script_array = [];
        foreach($nodes as $node){
            if($node->folder=='form'){
                array_push($script_array, 'form');
                $array['form_array'] = \FuncNode::get_items_array($node);
            } else if(in_array($node->name, ['photo','video','participant'])){
                array_push($script_array, 'lightbox');
                array_push($script_array, 'masonry');
            } else if(in_array($node->name, ['member', 'publication'])){
                array_push($script_array, 'masonry');
            } else if(in_array($node->name, ['project', 'contact'])){
                array_push($script_array, 'map');
                array_push($script_array, 'locations-'.$node->name);
                $array['location_array'] = \FuncNode::get_items_array($node);
                if($node->name=='project'){
                    array_push($script_array, 'owl-project');
                }
            } else if(in_array($node->name, ['banner'])){
                array_push($script_array, 'banner');
            }
            $array['script_array'] = $script_array;
        }
        return $array;
    }
    
    public static function before_migrate_actions() {
        // Acciones
    }

    public static function after_migrate_actions() {
        // Acciones
    }
    
    public static function before_seed_actions() {
        return 'Before seed realizado correctamente.';
    }

    public static function after_seed_actions() {
        // Añadir imagenes a páginas
        return 'After seed realizado correctamente.';
    }
       
    public static function get_sitemap_array($lang) {
        $array = [];
        /*if($lang=='es'){
            $array['member'] = ['url'=>'miembro/', 'url_id'=>'slug', 'priority'=>'0.7'];
            $array['article'] = ['url'=>'articulo/', 'url_id'=>'slug', 'priority'=>'0.5'];
        }*/
        return $array;
    }

    public static function get_indicator_result($type, $result_type, $sub_indicator, $start_date, $end_date) {
        $result = false;
        // Poner condicionatnes con resultados para devolver
        return $result;
    }
       
    public static function get_custom_field($name, $parameters, $array, $label, $col, $i, $value, $data_type) {
        // Type = list, item
        $return = NULL;
        if($name=='online_sale_button'){
            if($i){
                $return .= '<div class="col-sm-4"><br><a target="_blank" class="btn btn-site" href="'.url('admin/customer-online-order/supplier/'.$i->id).'?download-pdf=true" style="width: 100%;">Abrir PDF Proveedor</a></div>';
                $return .= '<div class="col-sm-4"><br><a target="_blank" class="btn btn-site" href="'.url('admin/customer-online-order/customer/'.$i->id).'?download-pdf=true" style="width: 100%;">Abrir PDF Cliente</a></div>';
            }
        } else if($name=='international_sale_button'){
            if($i){
                $return .= '<div class="col-sm-4"><br><a target="_blank" class="btn btn-site" href="'.url('admin/customer-international-order/'.$i->id).'?download-pdf=true" style="width: 100%;">Abrir PDF</a></div>';
            }
        }
        return $return;
    }

    public static function check_permission($type, $module, $node, $action, $id = NULL) {
        // Type = list, item
        $return = 'none';
        if($node->name=='temp-file'){
            if($type=='list'){
                $return = 'true';
            }
        }
        return $return;
    }

    public static function get_options_relation($submodel, $field, $subnode, $id = NULL) {
        return $submodel;
    }

    public static function custom_pdf_header($node, $id) {
        $message = 'Formulario de '.$node->singular;
        return $message;
    }  

}