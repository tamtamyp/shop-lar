<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\UserModel as UserModel;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Session;

session_start();

class AuthController extends Controller
{
    private $pathViewController = 'frontend.login';
    private $controllerName     = 'auth';
    private $params             = [];
    private $model;

    public function __construct()
    {
        $this->model = new UserModel();
        view()->share('controllerName', $this->controllerName);
    }
    public function login()
    {
        return view($this->pathViewController);
    }

    public function checkLogin(Request $request)
    {

        $email = $request->email;
        $password = md5($request->password);
        $result = UserModel::where('email', $email)->where('password', $password)->first(); //first lấy giới hạn 1 user
        // dd($result['status']);

        if ($result) {
            if($result['status']=='active'){
            $request->session()->put('username', $result->username);
            $request->session()->put('id_user', $result->id);
            $request->session()->put('level', $result->level);
            $request->session()->put('avatar', $result->avatar);
            return redirect()->route('home');
            }
            else {
                $request->session()->put('message', '<p style="color:white;">Tài khoản của bạn đang bị khóa!</p>');
                return redirect()->route('login');}
        } else {
            $request->session()->put('message', '<p style="color:white;">Tài khoản hoặc mật khẩu không chính xác!</p>');
            return redirect()->route('login');
        }
    }

    public function logout(Request $request)
    {
        if ($request->session()->has('username')) {
            session()->flush();
            // $request->session()->pull('username');
            // $request->session()->pull('level');
            // $request->session()->pull('avatar');
        }
        return redirect()->route('home');
    }
}
