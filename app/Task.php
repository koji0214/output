<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Task extends Model
{
    //
    public function getByLimit(int $limit_count = 5){
        // Auth_idでフィルタリング
        return $this->get();
    }//
    public function getPaginateByLimit(int $limit_count = 5){
        // updated_atで降順に並べたあと、limitで件数制限をかける
        return $this::with('category')->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
    public function category(){
        return $this->belongsTo('App\TaskCategory');
    }
}
