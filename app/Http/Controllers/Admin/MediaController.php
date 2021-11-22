<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public $model = null;
    public $params;
    private $pathViewController = 'admin.pages.media.';
    public function index()
    {
        

        return view(
            $this->pathViewController.'index'
        );
    }
}
