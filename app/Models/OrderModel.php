<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class OrderModel extends Model
{
    use HasFactory;
    protected $table = 'orders';
    public $timestamps = false;
    protected $fillable = ['order_note', 'customer_id', 'order_name', 'order_phone', 'order_email', 'order_address', 'status', 'total'];
    
    public function saveItem($params = null, $options = null)
    {
        if ($options['task'] == 'change-status') {
            $status = $params["currentStatus"];
            $modified    = $params['modified'];
            $modified_by = $params['modified_by'];
            self::where('id', $params['id'])->update(['status' => $status, 'modified_by' => $modified_by, 'modified' => $modified]);
        }
    }

}
