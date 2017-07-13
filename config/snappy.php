<?php

if(env('APP_SYSTEM', 'windows')=='windows'){
    $binary_folder = '';
    $zoom = '0.75';
} else {
    $binary_folder = '/usr/local/bin/';
    $zoom = '0.6';
}

return array(


    'pdf' => array(
        'enabled' => true,
        'binary' => $binary_folder.'wkhtmltopdf',
        'timeout' => false,
        'options' => array('dpi'=>'120', 'viewport-size'=>'1280x1024', 'margin-top'=>'28mm', 'margin-bottom'=>'18mm', 'margin-left'=>'16mm', 'margin-right'=>'16mm', 'disable-smart-shrinking'=>true, 'zoom'=>$zoom),
    ),
    'image' => array(
        'enabled' => true,
        'binary' => $binary_folder.'wkhtmltoimage',
        'timeout' => false,
        'options' => array(),
    ),


);
