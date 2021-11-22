<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class OrderDetailModel extends Model
{
    use HasFactory;
    protected $table = 'order_detail';
    public $timestamps = false;
    protected $fillable = ['order_id', 'product_id', 'price', 'quantity'];

    // public function getItems(){
    //     $result = null;
    //     $query = $this->join('product as p','product_id','=','p.id')->select('order_detail.order_id', 'p.name as product_name', 'order_detail.price', 'order_detail.quantity');
    //     $result = $query->get()->toArray();
    //     return $result;
    // }
}
