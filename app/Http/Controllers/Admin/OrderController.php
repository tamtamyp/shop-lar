<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\OrderModel as mainModel;

class OrderController extends Controller
{
    public $model = null;
    public $params;
    private $pathViewController = 'admin.pages.order.';

    public function __construct()
    {
        $this->model = new mainModel();
    }

    public function index()
    {
        $items = DB::table('orders')->join('user as u','customer_id','=','u.id')->select('orders.id', 'u.username as customer_name', 'orders.order_date','orders.status','orders.total')->orderBy('id','desc')->paginate(5);
        return view($this->pathViewController . 'index',compact('items'));
    }

    public function orderDetail($id)
    {
        $items = DB::table('orders')->where('id',$id)->first();
        $product = DB::table('order_detail')->join('product as p','product_id','=','p.id')->select('order_detail.order_id', 'p.name as product_name', 'order_detail.price', 'order_detail.quantity')->where('order_id',$id)->get();
        return response()->json([
            'items' => $items,
            'product' => $product,
        ]);
    }

    public function status(Request $request, $status, $id)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $params["currentStatus"]   = $request->selectValue;
        $params["id"]               = $id;
        $params["modified"]      = date('Y-m-d H:i:s', time());
        $params['modified_by']   = session()->get('username');
        // dd($id);
        $this->model->saveItem($params, ['task' => 'change-status']);

        $modified = date('Y-m-d H:i:s', strtotime($params["modified"]));
        $modified_by = session()->get('username');
        return response()->json([
            'status'      => 'success',
            'modified'    => $modified,
            'id'          => $id,
            'modified_by' => $modified_by,
        ]);
    }
}
