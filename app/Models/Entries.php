<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Entries extends Model
{
    protected $table = 'entries';
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];
}
