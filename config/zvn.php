<?php

return [

        'templates' => [
            'sidebar' =>[
                'dashboard' => ['link'=>'dashboard','class' => 'fa fa-home','name'=>'Home'],
                'media'     => ['link'=>'media','class' => 'fa fa fa-photo','name'=>'Media'],
                'post'      => ['link'=>'post','class' => 'fa fa fa-newspaper-o','name'=>'Post'],
                'order'      => ['link'=>'order','class' => 'fa fa fa-shopping-cart','name'=>'Order'],
                'category'  => ['link'=>'category','class' => 'fa fa fa-building-o','name'=>'Category'],
                'product'   => ['link'=>'product','class' => 'fa fa fa-product-hunt','name'=>'Product'],
                'sliders'   => ['link'=>'slider','class' => 'fa fa-sliders','name'=>'Sliders'],
                'user'      => ['link'=>'user','class' => 'fa fa-user','name'=>'User'],
                'setting'   => ['link'=>'setting','class' => 'fa fa-cog','name'=>'Setting'],
            ],
            'dashboard'=>[
                'post'     => ['class'=>'fa fa fa-newspaper-o','name'=>'Post','nameDB'=>'post','link'=>'post'],
                'order'     => ['class'=>'fa fa fa-shopping-cart','name'=>'Cart','nameDB'=>'orders','link'=>'order'],
                'category' => ['class'=>'fa fa fa-building-o','name'=>'Category','nameDB'=>'category','link'=>'category'],
                'product'  => ['class'=>'fa fa fa-product-hunt','name'=>'Product','nameDB'=>'product','link'=>'product'],
                'slider'   => ['class'=>'fa fa-sliders','name'=>'Slider','nameDB'=>'slider','link'=>'slider'],
                'user'     => ['class'=>'fa fa-user','name'=>'User','nameDB'=>'user','link'=>'user'],

            ],

            'mainmenu'=>[
                'about-us'   => ['name'=>'giới thiệu','link'=>'home'],
                'shop'       => ['name'=>'sản phẩm','link'=>'san-pham'],
                'post'       => ['name'=>'tin tức','link'=>'tin-tuc'],
                'Contact-Us' => ['name'=>'liên hệ','link'=>'home'],
            ],
        ],

        'url' =>[
            'prefix_admin'    => 'admin',
            "prefix_frontend" => '',
        ],

        
]
?>