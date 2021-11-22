<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\CategoryModel;
use App\Models\ProductModel as ProductModel;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public $model = null;
    public $params = [];
    private $pathViewController = 'frontend.pages.shop.';

    public function __construct()
    {
        $this->params = [];
        $this->model = new ProductModel();
        view()->share('controllerName', 'slider');
    }
    public function index(Request $request)
    {
        $category = CategoryModel::where('parent_id',0)->where('status','active')->get();
        $product =$this->model->getItems($request,$this->params, ['task' => 'show-product']);
        $featured =$this->model->getItems($request,$this->params, ['task' => 'show-featured']);
        // dd($product);
        return view($this->pathViewController.'index',compact('category','product','featured'));
    }
    
    //======= show detail product ========
    public function detail_product(Request $request){
        $items = $this->model->getDetail($request);
        $id = $request->product_id;
        
        $featured =$this->model->getItems($request,$this->params, ['task' => 'show-featured']);
        // dd($id);
        return view($this->pathViewController.'product.detail',compact('items','featured'));
    }

    //======= SHOW PRODUCT WITH CATEGORY ========
    public function getProductCate(Request $request){
        $id = $request->id;
        $category = CategoryModel::where('parent_id',0)->where('status','active')->get();
        $categoryName = CategoryModel::where('id',$id)->get('name');
        // dd($categoryName);
        $product =$this->model->getItems($request, $this->params, ['task' => 'show-with-category']);
        $featured =$this->model->getItems($request,$this->params, ['task' => 'show-featured']);
        // dd($product);
        return view($this->pathViewController.'index',compact('category','product','featured','categoryName'));
    }
}
