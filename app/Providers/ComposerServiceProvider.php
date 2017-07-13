<?php

namespace App\Providers;

use Illuminate\Contracts\View\Factory as ViewFactory;
use Solunes\Store\App\Providers\ComposerServiceProvider as ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{

    public function boot(ViewFactory $view)
    {
        view()->composer(['layouts.master', 'master::layouts.admin'], function ($view) {
            $array['footer_name'] = \FuncNode::check_var('footer_name');
            $array['footer_rights'] = \FuncNode::check_var('footer_rights');
            $array['social'] = \App\SocialNetwork::get();
            // Delivery Time
            $all = round((strtotime(date('2017-07-09 11:00:00')) - time()) / 60);
            $d = floor ($all / 1440);
            $h = floor (($all - $d * 1440) / 60);
            $m = $all - ($d * 1440) - ($h * 60);
            $array['delivery_time'] = array('hours'=>$h, 'mins'=>$m);
            // Delivery Time
            $view->with($array);
        });
        parent::boot($view);
    }

    public function register()
    {
        //
    }

}