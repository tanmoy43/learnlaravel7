<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id', 'category_name'
    ];

    public function user(){
        return $this->hasone(User::class,'id', 'user_id');
    }
}
