<?php

/*return [

   'view_replace_str'  =>  [
    '__PUBLIC__'=>SITE_URL.'/public/static/admin',
    '__IMG__'=>SITE_URL.'/public/static/admin',
    ],

    'template'               => [
        // 模板后缀
        'view_suffix'  => 'html',
    ],


    
];*/

//配置文件
return [
	'view_replace_str'       => [
        '_CSS_'=>DS.'Myblog'.DS.'public'.DS.'static'.DS.'home'.DS.'iconfont',
        '_JS_'=>DS.'Myblog'.DS.'public'.DS.'static'.DS.'home'.DS.'js',
        // '_IMG_'=>DS.'Myblog'.DS.'public'.DS.'static'.DS.'admin'.DS.'images',
        // '_SRC_' =>'/Myblog/public/Images',
    ],
];
