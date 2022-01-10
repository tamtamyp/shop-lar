<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryModel as mainModel;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    public $model = null;

    public $params;
    private $pathViewController = 'admin.pages.category.';
    public function __construct()
    {
        $this->model = new mainModel();
        view()->share('controllerName', 'category');
    }


    public function index()
    {
        // $items = mainModel::orderby('id','ASC')->search()->get();
        $items = $this->model->getItems($this->params, ['task' => 'change-all']);
        return view($this->pathViewController.'index',compact('items'));
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

    public function delete(Request $request, $id)
    {
        $items = mainModel::find($id);
        if ($items['status'] == 'active') {
            return response()->json([
                'message' =>'Không thể xóa danh mục đang active',
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
            $dbs = DB::delete('delete from category where id in (' . implode(',', $ids) . ')');
            return redirect()->route('category');
        } elseif ($request->bulk_action == 'active' && isset($ids)) {
            $dbs = DB::update('update category set status = ? where id in(' . implode(',', $ids) . ')', ['active']);
            return redirect()->route('category')->with('success', 'Cập nhật trạng thái thành công');
        } elseif ($request->bulk_action == 'inactive' && isset($ids)) {
            $dbs = DB::update('update category set status = ? where id in(' . implode(',', $ids) . ')', ['inactive']);
            return redirect()->route('category')->with('success', 'Cập nhật trạng thái thành công');
        } else {
            return redirect()->route('category')->with('error', 'Bạn chưa chọn hành động hoặc slider');
        }
    }

    public function edit(Request $request)
    {
        $items = $this->model->getEdit($request);
        $id = $request->id;
        $category = mainModel::where('parent_id',0)->where('status','active')->get();
        return view('admin.pages.category.edit',compact('items','category'));
    }

    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'name'   => 'bail|required|min:1|max:100',
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
        $category = mainModel::find($id);
        $data = array();
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $data['modified']    = date('Y-m-d H:i:s', time());
        $data['name']        = $request->name;
        $data['parent_id']   = $request->parent_id;
        $data['modified_by'] = session()->get('username');
        $data['status']      = $request->status;
        $data['slug']        = $request->slug;
        $this->model->where('id', $request->id)->update($data);
        return Redirect::to('admin/category')->with('success','Cập nhật thành công');
    }

    public function add(Request $request)
    {
        $category = mainModel::where('parent_id',0)->where('status','active')->orderby('id','ASC')->get();
        return view('admin.pages.category.add',compact('category'));
    }

    public function save(Request $request)
    {
        $this->validate(
            $request,
            [
                'name'    => 'bail|required|min:1|max:100|unique:category,name',
                'status'  => 'bail|in:active,inactive',
                'display' => 'bail|in:list,grid',
                'slug'    => 'required',
            ],
            [
                'name.required' => 'Bạn chưa nhập tên',
                'name.min'      => 'Bạn nhập tên quá ngắn',
                'name.max'      => 'Bạn nhập tên quá dài',
                'name.unique'   => 'Tên slide đã tồn tại',
                'status.in'     => 'Bạn chưa nhập trạng thái',
                'display.in'    => 'Bạn chưa nhập kiểu hiển thị',
                'slug.required' => 'Bạn chưa nhập slug',
            ]
        );
                    $data         = array();
              $data['name']       = $request->name;
              $data['parent_id']  = $request->parent_id;
              $data['status']     = $request->status;
              $data['display']    = $request->display;
              $data['slug']       = $request->slug;
              $data['created_by'] = session()->get('username');
        $this->model->insert($data);
        return Redirect::to('admin/category')->with('success', 'Lưu thành công');
    }


    public function status(Request $request)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $params["currentStatus"] = $request->status;
        $params["id"]            = $request->id;
        $params["modified"]      = date('Y-m-d H:i:s', time());
        $params['modified_by']   = session()->get('username');
        $this->model->saveItem($params, ['task' => 'change-status']);// doi du lieu trong db


        //doi giao dien
        $status   = $request->status == 'active' ? 'inactive' : 'active';

        $class = 'btn-danger';
        if($status == 'active'){
            $class = 'btn-success';
        }

        $link     = route('slider/status', ['status' => $status, 'id' => $request->id]);
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



    public function display(Request $request)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $params["currentDisplay"]   = $request->display;
        $params["id"]               = $request->id;
        $params["modified"]      = date('Y-m-d H:i:s', time());
        $params['modified_by']   = session()->get('username');
        $this->model->saveItem($params, ['task' => 'change-display']);

        $modified = date('Y-m-d H:i:s', strtotime($params["modified"]));
        $modified_by = session()->get('username');
        return response()->json([
            'status'      => 'success',
            'modified'    => $modified,
            'id'          => $request->id,
            'modified_by' => $modified_by,
        ]);
    }

    // public function orderItem(Request $request){
    //     $menuItemOrder = json_decode($request->input('order'));
    //     $this->orderMenu($menuItemOrder, null);
    // }
}
?>
