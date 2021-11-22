<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostModel extends Model
{
    use HasFactory;
    protected $table = 'post';
    public $timestamps = false;

    // public function __construct()
    // {
    //     $this->table  = 'post as p';
    // }
    public function getItems($params = null,$options = null)
    {

        $result = null;
        $query = $this->join('category as c','category_id','=','c.id')->select('post.id', 'post.name', 'post.content', 'post.status', 'post.thumb', 'post.created', 'post.created_by', 'post.modified', 'post.modified_by', 'post.publish_at', 'post.type', 'c.name as category_name')->orderby('post.id','desc');
        if($options['task'] == 'change-all')
        {
        $result = $query->search()->paginate(5);
        }
        if($options['task'] == 'change-active')
        {
        $result = $query->where('post.status', 'active')->search()->paginate(5);
        }
        if($options['task'] == 'change-inactive')
        {
        $result = $query->where('post.status', 'inactive')->search()->paginate(5);
        }
        return $result;
    }

    // public function getSlider()
    // {

    //     $result = null;
    //     $query = $this->select('id', 'name', 'description', 'link', 'thumb', 'status', 'created', 'modified', 'created_by', 'modified_by', 'ordering')->where('status','active');
    //     $result = $query->get()->toArray();
    //     return $result;
    // }

    public function getEdit(Request $request)
    {

        $result = null;
        $query = $this->join('category as c','category_id','=','c.id')->select('post.id', 'post.name', 'post.content', 'post.status', 'post.thumb', 'post.created', 'post.created_by', 'post.modified', 'post.modified_by', 'post.publish_at', 'post.type', 'c.name as category_name')->where('post.id', $request->id);
        $result = $query->get()->toArray();
        return $result;
    }

    //localscope
    public function scopeSearch($query)
    {

        if($search_value = request()->search_value){
            $query = $query->where('p.name','like','%'.$search_value.'%');
        }
        return $query;
    }
    
    public function saveItem($params = null,$options = null) {
        if($options['task'] == 'change-status'){
            $status = ($params['currentStatus']=='active')?'inactive':'active';
            $modified    = $params['modified'];
            self::where('id',$params['id'])->update(['status'=>$status, 'modified' => $modified]);
        }
    }
}
