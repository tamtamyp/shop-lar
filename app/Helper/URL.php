<?php

namespace App\Helper;

use Illuminate\Support\Facades\DB;

class URL
{
    //======= SHOW MENU ========
    public static function showMenu()
    {

        $arr = config('zvn.templates.mainmenu');
        $xhtml =  null;

        foreach ($arr as $key => $item) {

            $xhtml .= sprintf('<li class="menu-item"><a href="%s" class="link-term mercado-item-title"> %s</a>
    </li>', route($item['link']), $item['name']);
        }
        return $xhtml;
    }
}

