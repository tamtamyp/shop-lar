<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class SettingModel extends Model
{
    use HasFactory;
    protected $table = 'setting';
    public $timestamps = false;

    public function getItems(Request $request, $params = null, $option = null){
        
        $result = null;
        $query = $this->select('config_key', 'config_value', 'created', 'created_by', 'modified', 'modified_by');
        if($option['task'] == 'getItems'){
            $result = $query->search()->paginate(5);
        }
        if($option['task'] == 'getEdit'){
            $result = $query->where('config_key', $request->config_key)->get()->toArray();
        }

        return $result;
    }
    public function scopeSearch($query)
    {

        if ($search_value = request()->search_value) {
            $query = $query->where('config_key', 'like', '%' . $search_value . '%');
        }
        return $query;
    }
}
