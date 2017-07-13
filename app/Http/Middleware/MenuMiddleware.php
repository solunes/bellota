<?php

namespace App\Http\Middleware;

use Closure;
use Menu;
use Auth;

class MenuMiddleware
{
    /**
     * Run the request filter.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure                  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
      if(auth()->check()&&auth()->user()->isSuperAdmin()){
        $user_permissions = \Solunes\Master\App\Permission::lists('name');
      } else if(auth()->check()){
        $user_permissions = auth()->user()->getPermission();
      } else {
        $user_permissions = [];
      }
      $menu_options = \Solunes\Master\App\Menu::where('site_id', 1)->menuQuery('site', 1)->get();
      Menu::make('main', function($menu) use($request, $menu_options, $user_permissions) {
        foreach($menu_options as $key => $menu_option){
          if(!$menu_option->permission||(auth()->check()&&$user_permissions->contains($menu_option->permission))){
            $first_level = $menu->add($menu_option->name, $menu_option->real_link);
            if(count($menu_option->children)>0||$menu_option->page_id==3){
              //$first_level->prepend('<span class="fa fa-caret-down"></span> ');
              $first_level->attribute(['class' => 'dropdown hasmenu']);
              foreach($menu_option->children as $menu_children){
                if(!$menu_children->permission||(auth()->check()&&$user_permissions->contains($menu_children->permission))){
                  $second_level = $first_level->add($menu_children->name, $menu_children->real_link);
                  if(count($menu_children->children)>0){
                    $second_level->prepend('<span class="fa fa-caret-down"></span> ');
                    $second_level->attribute(['class' => 'dropdown hasmenu']);
                    foreach($menu_children->children as $menu_children2){
                      $third_level = $second_level->add($menu_children2->name, $menu_children2->real_link);
                    }
                  }
                }
              }
              if($menu_option->page_id==3){
                foreach(\Solunes\Store\App\Category::whereNull('parent_id')->get() as $category){
                  $second_level = $first_level->add($category->name, url('category/'.$category->slug));
                  if(count($category->children)>0){
                    $second_level->prepend('<span class="fa fa-caret-right"></span> ');
                    $second_level->attribute(['class' => 'dropdown hasmenu']);
                    foreach($category->children as $subcategory){
                      $third_level = $second_level->add($subcategory->name, url('category/'.$subcategory->slug));
                    }
                  }
                }
              }
            }
          }
        }
      });
      return $next($request);
    }
}