<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public $model = null;

    public function __construct()
    {
        view()->share('controllerName', 'slider');
    }
    public function index()
    {
        // dd(request()->search_value);
        // $items = $this->model->getSlider();
        // dd($items);
        return view('frontend.pages.post.index');
    }
    
    //======= show menu ========
}
