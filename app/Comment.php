<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = "comments";

    protected $fillable = ['text', 'user_id', 'parent_id'];

    protected $hidden = ['created_at', 'updated_at', 'user_id', 'parent_id', 'level'];

    public function child()
    {
       return $this->hasMany('App\Comment','parent_id', 'id');
    }
}
