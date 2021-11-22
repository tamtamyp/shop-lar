<?php

namespace App\Helper;

use Illuminate\Support\Facades\DB;

class Templates
{

    //======= SIDEBAR ========
    public static function showSidebar()
    {

        $arr = config('zvn.templates.sidebar');
        $side =  null;

        foreach ($arr as $key => $item) {

            $side .= sprintf('<li><a href="%s"><i class="%s"></i>%s</a></li>', route($item['link']), $item['class'], $item['name']);
        }
        return $side;
    }
    //======= SHOW DASHBOARD ========

    public static function showDashboard()
    {

        $arr = config('zvn.templates.dashboard');
        $dashboard =  null;

        foreach ($arr as $key => $item) {

            $dashboard .= sprintf('
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 " style="width:300px">
                <div class="tile-stats">
                    <div class="icon"><i class="%s"></i></div>
                    <div class="count">%s</div>
                    <h3>%s</h3>
                    <a href="%s" class=""><p>Xem chi tiết</p></a>
                </div>
            </div>',
             $item['class'],
             $item['name'],
             DB::table($item['nameDB'])->count(),
             route($item['link'])
            );
        }
        return $dashboard;
    }

    //======= SHOW IMG ========
    public static function showImage($controllerName, $nameimg, $name)
    {

        $image = sprintf(
            '<img style="width: 250px;" src="%s" alt="%s" class="zvn-thumb">', asset("templates/images/$nameimg"),$name);
        return $image;
    }

    public static function showImageProduct($controllerName, $nameimg, $name)
    {

        $image = sprintf(
            '<img style="width: 250px; height: 250px;" src="%s" alt="%s" class="zvn-thumb">', asset("templates/images/$nameimg"),$name);
        return $image;
    }

    public static function showImageHome($controllerName, $nameimg, $name)
    {

        $image = sprintf('<img style="width: 1170px; height: 500px;"
        src="%s" 
        alt="%s"
        class="img-slide">', 
        asset("templates/images/$nameimg"), $name);
        return $image;
    }
    public static function showImageMini($controllerName, $nameimg, $name)
    {

        $image = sprintf('<img style="width:50px; height:50px;"  
            src="%s" 
            alt="%s" class="zvn-thumb">', asset("templates/images/$nameimg"),$name);
        return $image;
    }

    public static function showDetailProduct($controllerName, $nameimg, $name)
    {

        $image = sprintf(
            '<img style="width: 470px; height: 470px;" src="%s" alt="product thumbnail" class="zvn-thumb">', asset("templates/images/$nameimg"));
        return $image;
    }
    
}
