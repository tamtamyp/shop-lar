<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductModel as mainModel;
use App\Models\CategoryModel;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Exports\ProductExport;
use App\Imports\ProductImport;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    public $model = null;
    public $params;
    private $pathViewController = 'admin.pages.product.';



    public function __construct()
    {
        $this->model = new mainModel();
        view()->share('controllerName', 'product');
    }


    public function index(Request $request)
    {
        // $items = $this->model->getItems($request,$this->params, ['task' => 'show-product']);
        $status = $request->status;
        $search_value = $request->search_value;
        $query = mainModel::addSelect(['category_name'=>CategoryModel::select('name')
        ->whereColumn('id', 'product.category_id')
        ])->orderby('product.id', 'desc');
        if (!empty($status)) {
            $query = $query->where('status', $status);
        }
        if (!empty($search_value)) {
            $query = $query->where('name', 'like', '%' . $search_value . '%');
        }
        $items = $query->paginate(10);
        return view(
            $this->pathViewController . 'index',
            compact('status', 'items')
        );
    }

    public function exportProduct(Request $request)
    {
        $filters = [
            'status' => $request->status,
        ];
        $response = Excel::download(new ProductExport($filters), 'exportProduct.xlsx', \Maatwebsite\Excel\Excel::XLSX);
        return $response;
    }

    public function importProduct(Request $request)
    {
        $file = $request->file;
        Excel::import(new ProductImport(), $file, \Maatwebsite\Excel\Excel::XLSX);
        // dd($file);
        return back();
    }

    public function delete(Request $request, $id)
    {
        $items = mainModel::find($id);
        if ($items['status'] == 'active') {
            return response()->json([
                'message' => 'Không thể xóa sản phẩm đang active',
            ]);
        } else {
            $this->model->where('id', $request->id)->delete();
            return response()->json([
                'status_code' => 200,
                'message'     => 'Xóa thành công'
            ]);
        }
    }

    public function action(Request $request)
    {
        $ids = $request->get('ids');
        if ($request->bulk_action == 'delete' && isset($ids)) {
            $dbs = DB::delete('delete from product where id in (' . implode(',', $ids) . ')');
            return redirect()->route('product');
        } elseif ($request->bulk_action == 'active' && isset($ids)) {
            $dbs = DB::update('update product set status = ? where id in(' . implode(',', $ids) . ')', ['active']);
            return redirect()->route('product')->with('success', 'Cập nhật trạng thái thành công');
        } elseif ($request->bulk_action == 'inactive' && isset($ids)) {
            $dbs = DB::update('update product set status = ? where id in(' . implode(',', $ids) . ')', ['inactive']);
            return redirect()->route('product')->with('success', 'Cập nhật trạng thái thành công');
        } else {
            return redirect()->route('product')->with('error', 'Bạn chưa chọn hành động hoặc sản phẩm');
        }
    }

    public function edit(Request $request)
    {

        $items = mainModel::addSelect(['category_name'=>CategoryModel::select('name')
        ->whereColumn('id', 'product.category_id')
        ->orderby('product.id', 'desc')
        ])->where('id', $request->id)->get();
        $id = $request->id;
        $category = CategoryModel::where('parent_id', 0)->where('status', 'active')->orderby('id', 'ASC')->get();
        return view($this->pathViewController . 'edit', ['items' => $items], ['category' => $category]);
    }

    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'name'       => 'bail|required|min:5|max:100',
                'price'      => 'required',
            ],
            [
                'name.required'  => 'Bạn chưa nhập tên',
                'name.min'       => 'Bạn nhập tên quá ngắn',
                'name.max'       => 'Bạn nhập tên quá dài',
                'name.unique'    => 'Tên slide đã tồn tại',
                'price.required' => 'Bạn chưa nhập giá',
            ]
        );
        $product       = mainModel::find($id);
        $data          = array();
        $data['name']        = $request->name;
        $data['content']     = $request->content;
        $data['description'] = $request->description;
        $data['status']      = $request->status;
        $data['category_id'] = $request->category_id;
        $data['type']        = $request->type;
        $data['price']       = $request->price;
        $data['sale_price']  = $request->sale_price;
        $data['modified_by'] = session()->get('username');
        $data['thumb']       = $request->thumb;
        $data['thumb_list']  = $request->thumb_list;
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $data['modified'] = date('Y-m-d H:i:s', time());
        $this->model->where('product.id', $request->id)->update($data);
        return Redirect::to('admin/product')->with('success', 'Cập nhật thành công');
    }

    public function add(Request $request)
    {

        $items = DB::table('category')->orderby('id', 'desc')->get();
        $category = CategoryModel::where('parent_id', 0)->where('status', 'active')->orderby('id', 'ASC')->get();
        return view($this->pathViewController . 'add', compact('items', 'category'));
    }

    public function save(Request $request)
    {
        $this->validate(
            $request,
            [
                'name'       => 'bail|required|min:5|max:100|unique:product,name',
                'price'      => 'required',
            ],
            [
                'name.required'  => 'Bạn chưa nhập tên',
                'name.min'       => 'Bạn nhập tên quá ngắn',
                'name.max'       => 'Bạn nhập tên quá dài',
                'name.unique'    => 'Tên slide đã tồn tại',
                'price.required' => 'Bạn chưa nhập giá',
            ]
        );
        $data          = array();
        $data['name']        = $request->name;
        $data['description'] = $request->description;
        $data['category_id'] = $request->category_id;
        $data['content']     = $request->content;
        $data['status']      = $request->status;
        $data['type']        = $request->type;
        $data['price']       = $request->price;
        if (!empty($request->sale_price)) {
            $data['sale_price']        = $request->sale_price;
        }
        $data['created_by'] = session()->get('username');
        $data['thumb']      = $request->thumb;
        $data['thumb_list']  = $request->thumb_list;
        $this->model->insert($data);
        return Redirect::to('admin/product')->with('success', 'Lưu thành công');
    }
    // public function showActive(Request $request)
    // {
    //     $items = $this->model->getItems($request, $this->params, ['task' => 'change-active']);
    //     return view(
    //         $this->pathViewController . 'index',
    //         [
    //             'items' => $items,
    //         ]
    //     );
    // }

    // public function showInactive(Request $request)
    // {
    //     $items = $this->model->getItems($request, $this->params, ['task' => 'change-inactive']);
    //     return view(
    //         $this->pathViewController . 'index',
    //         [
    //             'items' => $items,
    //         ]
    //     );
    // }

    public function status(Request $request)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $params["currentStatus"] = $request->status;
        $params["id"]            = $request->id;
        $params["modified"]      = date('Y-m-d H:i:s', time());
        $this->model->saveItem($params, ['task' => 'change-status']); // doi du lieu trong db


        //doi giao dien    
        $status   = $request->status == 'active' ? 'inactive' : 'active';

        $class = 'btn-danger';
        if ($status == 'active') {
            $class = 'btn-success';
        }

        $link     = route('product/status', ['status' => $status, 'id' => $request->id]);
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

    public function type(Request $request)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $params["currentType"]   = $request->type;
        $params["id"]               = $request->id;
        $params["modified"]      = date('Y-m-d H:i:s', time());
        $params['modified_by']   = session()->get('username');
        $this->model->saveItem($params, ['task' => 'change-type']);

        $modified = date('Y-m-d H:i:s', strtotime($params["modified"]));
        $modified_by = session()->get('username');
        return response()->json([
            'status'      => 'success',
            'modified'    => $modified,
            'id'          => $request->id,
            'modified_by' => $modified_by,
        ]);
    }
}
