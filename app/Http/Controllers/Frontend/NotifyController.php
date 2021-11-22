<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

// use Illuminate\Support\Facades\Session;

// session_start();

class NotifyController extends Controller
{
    private $pathViewController = 'frontend.pages.notify.';
    private $controllerName     = 'auth';
    private $params             = [];
    private $model;

    public function __construct()
    {
        view()->share('controllerName', $this->controllerName);
    }
    public function noPermission(Request $request)
    {   
        return view($this->pathViewController.'no-permission');
    }

    public function noLogin(Request $request)
    {   
        return view($this->pathViewController.'no-login');
    }
}
