<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
class DashboardController extends Controller
{

    public function index(){
        return view('admin.pages.dashboard.index');
    }

}
