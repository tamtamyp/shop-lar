<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\OrderModel as OrderModel;
use App\Models\OrderDetailModel as OrderDetailModel;
use Illuminate\Support\Facades\Redirect;
use Session;

session_start();
class CheckoutController extends Controller
{

    public $order = null;
    public $params = [];
    private $pathViewController = 'frontend.pages.shop.';

    public function __construct()
    {
        $this->params = [];
        $this->order = new OrderModel();
        $this->order_details = new OrderDetailModel();
    }
    public function index()
    {
        $cart = session()->get('cart');
        // dd($cart);
        return view($this->pathViewController . 'checkout.index', compact('cart'));
    }


    public function save(Request $request)
    {
        // dd($request);
        if ($order = OrderModel::create([
            'order_name' => $request->fname,
            'order_note' => $request->note,
            'customer_id' => session()->get('id_user'),
            'order_phone' => $request->phone,
            'order_email' => $request->email,
            'order_address' => $request->address,
            'status' => 'pending',
            'total' => $request->total,

        ])) {
            $order_id = $order->id;
            $cart = session()->get('cart');
            foreach ($cart as $id => $item) {
                $price = empty($item['sale_price']) ? $item['sale_price'] : $item['price'];
                OrderDetailModel::create([
                    'order_id'   => $order_id,
                    'product_id' => $item['id'],
                    'price'      => isset($item['sale_price']) ? $item['sale_price'] : $item['price'],
                    'quantity'   => $item['quantity'],
                ]);
            }

            session(['cart' => []]);
            return redirect()->route('dat-hang/thankyou');
        }
    }

    public function thankyou()
    {
        return view($this->pathViewController . 'checkout.thankyou');
    }

    public function order()
    {
        $items = DB::table('orders')->where('customer_id',session()->get('id_user'))->orderBy('id','desc')->get();
        return view($this->pathViewController . 'order.order',compact('items'));
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
}
