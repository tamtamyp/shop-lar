<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryModel extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function __construct()
    {
        $this->table  = 'category';
    }
    public function getItems($params = null,$options = null)
    {

        $result = null;
        $query = $this->select('id', 'name', 'status', 'display', 'created', 'created_by', 'modified', 'modified_by', 'parent_id','slug')->orderby('id','asc');
        if($options['task'] == 'change-all')
        {
        $result = $query->where('parent_id',0)->search()->paginate(5);
        }
        if($options['task'] == 'change-active')
        {
        $result = $query->where('parent_id',0)->where('status', 'active')->search()->paginate(5);
        }
        if($options['task'] == 'change-inactive')
        {
        $result = $query->where('status', 'inactive')->search()->paginate(5);
        }
        return $result;
    }

    public function children(){
        return $this->hasMany(self::class,'parent_id','id')->where('status','active')->orderBy('name', 'asc');
    }

    public function parent(){
        return $this->belongsTo(self::class,'parent_id')->where('parent_id',0);
    }

    public function getEdit(Request $request)
    {

        $result = null;
        $query = $this->select('id', 'name', 'status', 'created', 'created_by', 'modified', 'modified_by', 'display', 'parent_id','slug')->where('id', $request->id);
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

        if($options['task'] == 'change-is_home'){
            $is_home = ($params['currentIs_home']=='yes')?'no':'yes';
            $modified    = $params['modified'];
            $modified_by = $params['modified_by'];
            self::where('id',$params['id'])->update(['is_home'=>$is_home, 'modified' => $modified, 'modified_by' => $modified_by]);
        }

        if ($options['task'] == 'change-display') {
            $display     = ($params["currentDisplay"]=='list') ? 'grid' : 'list';
            $modified    = $params['modified'];
            $modified_by = $params['modified_by'];
            self::where('id', $params['id'])->update(['display' => $display, 'modified' => $modified, 'modified_by' => $modified_by]);
        }

    }
}
