<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SliderModel as mainModel;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SliderController extends Controller
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
        $items = $this->model->getItems();
        $items = $this->model::orderBy('id', 'ASC')->search()->paginate(3);

        return view(
            'admin.pages.slider.index',
            [
                'items' => $items,
            ]
        );
    }

    // public function form()
    // {
    //     // dd(request()->search_value);
    //     $items = $this->model->getItems();
    //     $items = $this->model::orderBy('id', 'ASC')->search()->paginate(3);

    //     return view('admin.pages.slider.index',compact('items'));
    // }

    public function delete(Request $request, $id)
    {
        $items = mainModel::find($id);
        if ($items['status'] == 'active') {
            return response()->json([
                'message' =>'Không thể xóa slider đang active',
            ]);
        } else {
            $this->model->where('id', $request->id)->delete();
            return response()->json([
                'status_code' => 200,
                'message'     => 'Xóa thành công']);
        }

    }

    public function action(Request $request)
    {
        $ids = $request->get('ids');
        if ($request->bulk_action == 'delete' && isset($ids)) {
            $dbs = DB::delete('delete from slider where id in (' . implode(',', $ids) . ')');
            return redirect()->route('slider');
        } elseif ($request->bulk_action == 'active' && isset($ids)) {
            $dbs = DB::update('update slider set status = ? where id in(' . implode(',', $ids) . ')', ['active']);
            return redirect()->route('slider')->with('success', 'Cập nhật trạng thái thành công');
        } elseif ($request->bulk_action == 'inactive' && isset($ids)) {
            $dbs = DB::update('update slider set status = ? where id in(' . implode(',', $ids) . ')', ['inactive']);
            return redirect()->route('slider')->with('success', 'Cập nhật trạng thái thành công');
        } else {
            return redirect()->route('slider')->with('error', 'Bạn chưa chọn hành động hoặc slider');
        }
    }

    public function edit(Request $request)
    {

        $items = $this->model->getEdit($request);
        $id = $request->id;
        return view('admin.pages.slider.edit', ['items' => $items]);
    }

    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'name'   => 'bail|required|min:5|max:100',
                'link'   => 'url',
                'status' => 'bail|in:active,inactive',
            ],
            [
                'name.min'        => 'Bạn nhập tên quá ngắn',
                'name.max'        => 'Bạn nhập tên quá dài',
                'link.url'       => 'Link không hợp lệ',
                'status.in'      => 'Bạn chưa nhập trạng thái',
            ]
        );
        $slider = mainModel::find($id);
        $data = array();
        $data['name'] = $request->name;
        $data['link'] = $request->link;
        $data['description'] = $request->description;
        $data['modified_by'] = session()->get('username');
        $data['status'] = $request->status;
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $data['modified'] = date('Y-m-d H:i:s', time());
            $data['thumb'] = $request->thumb;
        $this->model->where('id', $request->id)->update($data);
        return Redirect::to('admin/slider')->with('success','Cập nhật thành công');
    }

    public function add(Request $request)
    {

        return view('admin.pages.slider.add');
    }

    public function save(Request $request)
    {
        $this->validate(
            $request,
            [
                'name'   => 'bail|required|min:5|max:100|unique:slider,name',
                'link'   => 'url',
                'status' => 'bail|in:active,inactive',
            ],
            [
                'name.required'  => 'Bạn chưa nhập tên',
                'name.min'       => 'Bạn nhập tên quá ngắn',
                'name.max'       => 'Bạn nhập tên quá dài',
                'name.unique'    => 'Tên slide đã tồn tại',
                'link.url'       => 'Link không hợp lệ',
                'status.in'      => 'Bạn chưa nhập trạng thái',
            ]
        );
        $data = array();
        $data['name'] = $request->name;
        $data['link'] = $request->link;
        $data['description'] = $request->description;
        $data['status'] = $request->status;
        $data['created_by'] = session()->get('username');
            $data['thumb'] = $request->thumb;
        $this->model->insert($data);
        return Redirect::to('admin/slider')->with('success', 'Lưu thành công');
    }
    public function showActive()
    {
        $items = $this->model->getItems();
        $items = $this->model::where('status', 'active')->search()->Paginate(3);
        return view(
            'admin.pages.slider.index',
            [
                'items' => $items,
            ]
        );
    }

    public function showInactive()
    {
        $items = $this->model->getItems();
        $items = $this->model::where('status', 'inactive')->search()->Paginate(3);
        return view(
            'admin.pages.slider.index',
            [
                'items' => $items,
            ]
        );
    }

    public function status(Request $request)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $params["currentStatus"] = $request->status;
        $params["id"]            = $request->id;
        $params['modified_by']   = session()->get('username');
        $params["modified"]      = date('Y-m-d H:i:s', time());
        $this->model->saveItem($params, ['task' => 'change-status']);// doi du lieu trong db


        //doi giao dien    
        $status   = $request->status == 'active' ? 'inactive' : 'active';

        $class = 'btn-danger';
        if($status == 'active'){
            $class = 'btn-success';
        }

        $link        = route('slider/status', ['status' => $status, 'id' => $request->id]);
        $modified    = date('Y-m-d H:i:s', strtotime($params["modified"]));
        $modified_by = session()->get('username');


        return response()->json([

            'link'        => $link,
            'modified'    => $modified,
            'status'      => $status,
            'class'       => $class,
            'id'          => $request->id,
            'modified_by' => $modified_by,
        ]);
    }

    // public function status(Request $request)
    // {
    //     $params['currentStatus'] = $request->status;
    //     $params['id'] = $request->id;
    //     $this->model->saveItem($params, ['task' => 'change-status']);

    //     $status = $request->status == 'active' ? 'inactive' : 'active';
    //     $class = $request->status == 'active' ? 'btn-danger' : 'btn-success';
    //     $link = route('slider/status', ['status' => $status, 'id' => $request->id]);
    //     return response()->json([
    //         'link'   => $link,
    //         'status' => $status,
    //         'class'  => $class,
    //         'id'     => $request->id,
    //     ]);
    // }
    
}
