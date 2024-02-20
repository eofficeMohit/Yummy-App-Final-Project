<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chat extends Model
{
    use HasFactory;
    use SoftDeletes;

    // public function level()
    // {
    //     return $this->belongsTo(Level::class,'level','id');
    // }

    // public function category()
    // {
    //     return $this->belongsTo(Category::class,'category_id','id');
    // }
}
