<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SettingModel as mainModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SettingController extends Controller
{
    public $model = null;
    public $params = [];
    private $pathViewController = 'admin.pages.setting.';

    public function __construct()
    {
        $this->model = new mainModel();
        $this->params = [];
        view()->share('controllerName', 'setting');
    }

    public function index(Request $request)
    {
        $items = $this->model->getItems($request, $this->params, ['task' => 'getItems']);
        return view(
            $this->pathViewController.'index',compact('items')
        );
    }

    public function edit(Request $request)
    {

        $items = $this->model->getItems($request, $this->params, ['task' => 'getEdit']);
        $config_key = $request->config_key;
        // $category = CategoryModel::where('parent_id',0)->where('status','active')->orderby('id','ASC')->get();
        return view($this->pathViewController.'edit', compact('items'));
    }
    
    public function update(Request $request)
    {
        $this->validate(
            $request,
            [
                'config_key'       => 'unique:setting,config_key',
            ],
            [
                'config_key.unique'    => 'Giá trị đã tồn tại',
            ]
        );
              $data          = array();
        $data['config_value'] = $request->config_value;
        $data['modified_by'] = session()->get('username');
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $data['modified'] = date('Y-m-d H:i:s', time());
        $this->model->where('config_key', $request->config_key)->update($data);
        return Redirect::to('admin/setting')->with('success','Cập nhật thành công');
    }

}
