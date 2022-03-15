<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\CategoryModel;
use App\Models\ProductModel as ProductModel;
use Illuminate\Http\Request;
use Session;

class CartController extends Controller
{
    public $model = null;
    public $params = [];
    private $pathViewController = 'frontend.pages.shop.';

    public function __construct()
    {
        $this->params = [];
    }
    public function index()
    {
        $cart = session()->get('cart');
        // dd($cart);
        return view($this->pathViewController . 'cart.index', compact('cart'));
    }

    public function add(Request $request, $id)
    {
        // session()->flush('cart');
        
        $product = ProductModel::find($id);
        $cart = session()->get('cart');
        if (isset($cart[$id]))  //nếu đã tồn tại sản phẩm trong giỏ hàng
        {
            $cart[$id]['quantity'] = $cart[$id]['quantity'] + $request->quantity;

        } 
        else  //nếu chưa tồn tại sản phẩm trong giỏ hàng
        {
            $cart[$id] = [ //id product
                'id' => $product->id,
                'name'       => $product->name,
                'price'      => $product->price,
                'sale_price' => $product->sale_price,
                'quantity'   => $request->quantity,
                'thumb'      => $product->thumb,
            ];
        }
        session()->put('cart', $cart);
        return response()->json([
            'status' => 200,
            'message' => 'Thêm sản phẩm thành công',
        ]);
    }

    public function delete(Request $request)
    {
        $carts = session()->get('cart');
        unset($carts[$request->id]);
        session()->put('cart', $carts);
        return response()->json([
            'status_code' => 200,
            'message'     => 'Xóa thành công'
        ]);
    }

    public function clear()
    {
        session(['cart' => []]);
        return response()->json([
            'status_code' => 200
        ]);
    }
}
