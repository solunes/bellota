<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'froala' => [
        'key' => env('FROALA_KEY', 'BrmoqkctA3jef=='),
    ],

    'mailgun' => [
        'domain' => 'solumails.com',
        'secret' => 'key-8384bc97dca8f049aabdf9be140c85ae',
    ],

    'mandrill' => [
        'secret' => '',
    ],

    'ses' => [
        'key'    => '',
        'secret' => '',
        'region' => 'us-east-1',
    ],

    'stripe' => [
        'model'  => App\User::class,
        'key'    => '',
        'secret' => '',
    ],

    'facebook' => [
        'id' => '1618473038435404',
        'secret' => '7e9bac78b81d41306dda1f72a53dabea',
        'page' => '383876805090309',
    ],

    'rss_sources' => [
      'http://www.eldia.com.bo/rss.php', 
      'http://www.la-razon.com/rss/nacional/',
      'http://rss.eldiario.net/nacional.php',
      'http://www.lostiempos.com/rss/lostiempos-ultimas.xml',
      'http://www.laprensa.com.bo/rss/laprensa-titulares.xml',
      'http://www.jornadanet.com/rss/Portada.xml',
      'http://feeds.feedburner.com/ErnestoJustiniano',
      'http://www3.abi.bo/rss/abi.xml',
      'http://www.hoybolivia.com/rss.php'
    ],

];
