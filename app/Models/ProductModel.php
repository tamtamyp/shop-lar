<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ProductModel extends Model
{
    use HasFactory;
    protected $table = 'product';
    public $timestamps = false;
    protected $fillable = ['id', 'name', 'category_id', 'description', 'content', 'price', 'sale_price', 'thumb', 'thumb_list', 'status', 'type', 'created', 'created_by', 'modified', 'modified_by'];

    // public function __construct()
    // {
    //     $this->table  = 'product as p';
    // }
    public function categories() {
        return $this->belongsTo('App\Models\CategoryModel');
    }
    // public function getItems(Request $request, $params = null, $options = null)
    // {

    //     $result = null;
    //     $query = $this->join('category as c', 'category_id', '=', 'c.id')->select('id', 'name', 'content', 'description', 'price', 'sale_price', 'status', 'type', 'thumb', 'created', 'created_by', 'modified', 'modified_by', 'c.name as category_name')->orderby('id', 'desc');
    //     if ($options['task'] == 'change-all') {
    //         $result = $query->search()->paginate(5);
    //     }
    //     if ($options['task'] == 'change-active') {
    //         $result = $query->where('status', 'active')->search()->paginate(5);
    //     }
    //     if ($options['task'] == 'change-inactive') {
    //         $result = $query->where('status', 'inactive')->search()->paginate(5);
    //     }
    //     //======= show ra trang chủ ========
    //     if ($options['task'] == 'show-product') {
    //         $result = $query->where('status', 'active')->paginate(12);
    //     }
    //     //======= show sản phẩm nổi bật ra trang chủ ========
    //     if ($options['task'] == 'show-featured') {
    //         $result = $query->where('type', 'featured')->get();
    //     }
    //     //======= show sản phẩm theo danh mục ra trang chủ ========
    //     if ($options['task'] == 'show-with-category') {
    //         $result = $query->where('category_id', $request->id)->paginate(12);
    //     }
    //     return $result;
    // }

    public function children()
    {
        return $this->hasMany(CategoryModel::class, 'parent_id', 'id')->where('status', 'active')->orderBy('name', 'asc');
    }

    // public function getEdit(Request $request)
    // {

    //     $result = null;
    //     $query = $this->join('category as c', 'category_id', '=', 'c.id')->select('id', 'name', 'content', 'description', 'price', 'sale_price', 'status', 'type', 'thumb', 'thumb_list', 'created', 'created_by', 'modified', 'modified_by', 'c.name as category_name')->where('id', $request->id);
    //     $result = $query->get()->toArray();
    //     return $result;
    // }

    //localscope
    // public function scopeSearch($query)
    // {

    //     if ($search_value = request()->search_value) {
    //         $query = $query->where('name', 'like', '%' . $search_value . '%');
    //     }
    //     return $query;
    // }

    public function saveItem($params = null, $options = null)
    {
        if ($options['task'] == 'change-status') {
            $status = ($params['currentStatus'] == 'active') ? 'inactive' : 'active';
            $modified    = $params['modified'];
            self::where('id', $params['id'])->update(['status' => $status, 'modified' => $modified]);
        }

        if ($options['task'] == 'change-type') {
            $type     = ($params["currentType"] == 'featured') ? 'normal' : 'featured';
            $modified    = $params['modified'];
            $modified_by = $params['modified_by'];
            self::where('id', $params['id'])->update(['type' => $type, 'modified' => $modified, 'modified_by' => $modified_by]);
        }
    }
    //======= show detail product ========
    // public function getDetail(Request $request)
    // {

    //     $result = null;
    //     $query = $this->join('category as c', 'category_id', '=', 'c.id')->select('product.id', 'product.name', 'product.content', 'product.description', 'product.price', 'product.sale_price', 'product.status', 'product.type', 'product.thumb', 'product.thumb_list', 'product.created', 'product.created_by', 'product.modified', 'product.modified_by', 'c.name as category_name')->where('product.id', $request->product_id);
    //     $result = $query->get()->toArray();
    //     return $result;
    // }
}
