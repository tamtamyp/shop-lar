<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserModel as mainModel;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public $model = null;

    public function __construct()
    {
        $this->model = new mainModel();
        view()->share('controllerName', 'user');
    }


    public function index()
    {
        // dd(request()->search_value);
        $items = $this->model->getItems();
        $items = $this->model::orderBy('id', 'ASC')->search()->paginate(3);

        return view(
            'admin.pages.user.index',
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
                'message' =>'Không thể xóa user đang active',
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
            $dbs = DB::delete('delete from user where id in (' . implode(',', $ids) . ')');
            return redirect()->route('user');
        } elseif ($request->bulk_action == 'active' && isset($ids)) {
            $dbs = DB::update('update user set status = ? where id in(' . implode(',', $ids) . ')', ['active']);
            return redirect()->route('user')->with('success', 'Cập nhật trạng thái thành công');
        } elseif ($request->bulk_action == 'inactive' && isset($ids)) {
            $dbs = DB::update('update user set status = ? where id in(' . implode(',', $ids) . ')', ['inactive']);
            return redirect()->route('user')->with('success', 'Cập nhật trạng thái thành công');
        } else {
            return redirect()->route('user')->with('error', 'Bạn chưa chọn hành động hoặc user');
        }
    }

    public function edit(Request $request)
    {

        $items = $this->model->getEdit($request);
        $id = $request->id;
        return view('admin.pages.user.edit', ['items' => $items]);
    }

    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'fullname'   => 'bail|required|min:5|max:100',

            ],
            [
                'name.min'        => 'Bạn nhập tên quá ngắn',
                'name.max'        => 'Bạn nhập tên quá dài',
            ]
        );
        $user = mainModel::find($id);
        $data = array();
        $data['email'] = $request->email;
        $data['fullname'] = $request->fullname;
        $data['status'] = $request->status;
        $data['level'] = $request->level;
        $data['modified_by'] = session()->get('username');
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $data['modified'] = date('Y-m-d H:i:s', time());
        if($request->password != null){
            $data['password'] = md5($request->password);
        }
            $data['avatar'] = $request->thumb;
        $this->model->where('id', $request->id)->update($data);
        return Redirect::to('admin/user')->with('success', 'Lưu thành công');
    }

    public function add(Request $request)
    {

        return view('admin.pages.user.add');
    }

    public function save(Request $request)
    {
        $this->validate(
            $request,
            [
                'username' => 'bail|required|max:100|unique:user,username|regex:/(^([a-zA-Z]+)(\d+)?$)/u',
                'status'   => 'bail|in:active,inactive',
                'avatar'   => 'bail|image|mimes:jpg,png,jpeg,gif,svg',
                'email'    => 'required|email|unique:user,email',
                'level'    => 'bail|in:admin,editor,member',
                'password' => 'bail|required|min:8|max:100|regex:/(^([a-zA-Z]+)(\d+)?$)/u',
            ],
            [
                'username.required' => 'Bạn chưa nhập tên',
                'username.regex'    => 'Tên đăng nhập không được chứa khoảng cách hoặc ký tự đặc biệt',
                'username.max'      => 'Bạn nhập tên quá dài',
                'username.unique'   => 'Tên đăng nhập đã tồn tại',
                'status.in'         => 'Bạn chưa nhập trạng thái',
                'status.in'         => 'Bạn chưa nhập vai trò',
                'email.required'    => 'Bạn chưa nhập email',
                'email.email'       => 'Bạn nhập chưa đúng định dạng mail',
                'email.unique'      => 'Email này đã được đăng ký',
                'password.min'      => 'Mật khẩu tối thiểu 8 ký tự'
            ]
        );
        $data = array();
        $data['username'] = $request->username;
        $data['email'] = $request->email;
        $data['fullname'] = $request->fullname;
        $data['status'] = $request->status;
        $data['level'] = $request->level;
        $data['created_by'] = session()->get('username');
        $data['password'] = md5($request->password);
            $data['avatar'] = $request->thumb;
        $this->model->insert($data);
        return Redirect::to('admin/user')->with('success', 'Lưu thành công');
    }
    public function showActive()
    {
        $items = $this->model->getItems();
        $items = $this->model::where('status', 'active')->search()->Paginate(3);
        return view(
            'admin.pages.user.index',
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
            'admin.pages.user.index',
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

        $link     = route('user/status', ['status' => $status, 'id' => $request->id]);
        $modified = date('Y-m-d H:i:s', strtotime($params["modified"]));
        $modified_by = session()->get('username');


        return response()->json([

            'link'     => $link,
            'modified' => $modified,
            'status'   => $status,
            'class'    => $class,
            'id'       => $request->id,
            'modified_by' => $modified_by,
        ]);
    }
    
}
