<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class SliderModel extends Model
{
    use HasFactory;
    protected $table = 'slider';
    public $timestamps = false;

    public function getItems()
    {

        $result = null;
        $query = $this->select('id', 'name', 'description', 'link', 'thumb', 'status', 'created', 'modified', 'created_by', 'modified_by', 'ordering');
        $result = $query->get()->toArray();
        return $result;
    }

    public function getSlider()
    {

        $result = null;
        $query = $this->select('id', 'name', 'description', 'link', 'thumb', 'status', 'created', 'modified', 'created_by', 'modified_by', 'ordering')->where('status','active');
        $result = $query->get()->toArray();
        return $result;
    }

    public function getEdit(Request $request)
    {

        $result = null;
        $query = $this->select('id', 'name', 'description', 'link', 'thumb', 'status', 'created', 'modified', 'created_by', 'modified_by', 'ordering')->where('id', $request->id);
        $result = $query->get()->toArray();
        return $result;
    }

    //localscope
    public function scopeSearch($query)
    {

        if($search_value = request()->search_value){
            $query = $query->where('name','like','%'.$search_value.'%');
        }
        return $query;
    }
    
    public function saveItem($params = null,$options = null) {
        if($options['task'] == 'change-status'){
            $status = ($params['currentStatus']=='active')?'inactive':'active';
            $modified    = $params['modified'];
            $modified_by = $params['modified_by'];
            self::where('id',$params['id'])->update(['status'=>$status, 'modified' => $modified, 'modified_by' => $modified_by]);
        }
    }
}
