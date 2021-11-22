<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\SliderModel as mainModel;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    public $model = null;

    public function __construct()
    {
        $this->model = new mainModel();
        view()->share('controllerName', 'slider');
    }
    public function index()
    {
        // dd(request()->search_value);
        $items = $this->model->getSlider();
        // dd($items);
        return view('frontend.pages.index',compact('items'));
    }
    
    //======= show menu ========
    public function showMenu()
    {
        
    }
}
