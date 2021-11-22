<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PostModel as mainModel;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PostController extends Controller
{
    public $model = null;
    public $params;
    private $pathViewController = 'admin.pages.post.';
    


    public function __construct()
    {
        $this->model = new mainModel();
        view()->share('controllerName', 'post');
    }


    public function index()
    {
        $items = $this->model->getItems($this->params, ['task' => 'change-all']);
        return view(
            $this->pathViewController.'index',
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

    //     return view('admin.pages.post.index',compact('items'));
    // }

    public function delete(Request $request, $id)
    {
        $items = mainModel::find($id);
        if ($items['status'] == 'active') {
            return response()->json([
                'message' =>'Không thể xóa post đang active',
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
            $dbs = DB::delete('delete from post where id in (' . implode(',', $ids) . ')');
            return redirect()->route('post');
        } elseif ($request->bulk_action == 'active' && isset($ids)) {
            $dbs = DB::update('update post set status = ? where id in(' . implode(',', $ids) . ')', ['active']);
            return redirect()->route('post')->with('success', 'Cập nhật trạng thái thành công');
        } elseif ($request->bulk_action == 'inactive' && isset($ids)) {
            $dbs = DB::update('update post set status = ? where id in(' . implode(',', $ids) . ')', ['inactive']);
            return redirect()->route('post')->with('success', 'Cập nhật trạng thái thành công');
        } else {
            return redirect()->route('post')->with('error', 'Bạn chưa chọn hành động hoặc post');
        }
    }

    public function edit(Request $request)
    {

        $items = $this->model->getEdit($request);
        $id = $request->id;
        $cate = DB::table('category')->orderby('id','desc')->get();
        return view($this->pathViewController.'edit', ['items' => $items],['cate' => $cate]);
    }

    public function update(Request $request, $id )
    {
        $this->validate(
            $request,
            [
                'name'   => 'bail|required|min:5|max:100',
                // 'thumb'  => 'bail|image|mimes:jpg,png,jpeg,gif,svg',
            ],
            [
                'name.required'  => 'Bạn chưa nhập tên',
                'name.min'       => 'Bạn nhập tên quá ngắn',
                'name.max'       => 'Bạn nhập tên quá dài',
                'name.unique'    => 'Tên slide đã tồn tại',
            ]
        );
              $post          = mainModel::find($id);
              $data          = array();
        $data['name']        = $request->name;
        $data['category_id'] = $request->category_id;
        $data['content']     = $request->content;
        $data['status']      = $request->status;
        $data['type']        = $request->type;
        $data['modified_by']  = session()->get('username');
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $data['modified'] = date('Y-m-d H:i:s', time());
            $data['thumb'] = $request->thumb;
            // dd($data);
        $this->model->where('post.id', $request->id)->update($data);
        return Redirect::to('admin/post')->with('success','Cập nhật thành công');
    }

    public function add(Request $request)
    {

        $items = DB::table('category')->orderby('id','desc')->get();
        return view($this->pathViewController.'add',['items' => $items]);
    }

    public function save(Request $request)
    {
        $this->validate(
            $request,
            [
                'name'   => 'bail|required|min:5|max:100|unique:post,name',
                // 'thumb'  => 'bail|image|mimes:jpg,png,jpeg,gif,svg',
            ],
            [
                'name.required'  => 'Bạn chưa nhập tên',
                'name.min'       => 'Bạn nhập tên quá ngắn',
                'name.max'       => 'Bạn nhập tên quá dài',
                'name.unique'    => 'Tên slide đã tồn tại',
            ]
        );
              $data          = array();
        $data['name']        = $request->name;
        $data['category_id'] = $request->category_id;
        $data['content']     = $request->content;
        $data['status']      = $request->status;
        $data['type']        = $request->type;
        $data['created_by']  = session()->get('username');
            $data['thumb'] = $request->thumb;
        $this->model->insert($data);
        return Redirect::to('admin/post')->with('success', 'Lưu thành công');
    }
    public function showActive()
    {
        $items = $this->model->getItems($this->params, ['task' => 'change-active']);
        return view(
            $this->pathViewController.'index',
            [
                'items' => $items,
            ]
        );
    }

    public function showInactive()
    {
        $items = $this->model->getItems($this->params, ['task' => 'change-inactive']);
        return view(
            $this->pathViewController.'index',
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
        $params["modified"]      = date('Y-m-d H:i:s', time());
        $this->model->saveItem($params, ['task' => 'change-status']);// doi du lieu trong db


        //doi giao dien    
        $status   = $request->status == 'active' ? 'inactive' : 'active';

        $class = 'btn-danger';
        if($status == 'active'){
            $class = 'btn-success';
        }

        $link     = route('post/status', ['status' => $status, 'id' => $request->id]);
        $modified = date('Y-m-d H:i:s', strtotime($params["modified"]));


        return response()->json([

            'link'     => $link,
            'modified' => $modified,
            'status'   => $status,
            'class'    => $class,
            'id'       => $request->id,
        ]);
    }

    // public function status(Request $request)
    // {
    //     $params['currentStatus'] = $request->status;
    //     $params['id'] = $request->id;
    //     $this->model->saveItem($params, ['task' => 'change-status']);

    //     $status = $request->status == 'active' ? 'inactive' : 'active';
    //     $class = $request->status == 'active' ? 'btn-danger' : 'btn-success';
    //     $link = route('post/status', ['status' => $status, 'id' => $request->id]);
    //     return response()->json([
    //         'link'   => $link,
    //         'status' => $status,
    //         'class'  => $class,
    //         'id'     => $request->id,
    //     ]);
    // }
    
}
