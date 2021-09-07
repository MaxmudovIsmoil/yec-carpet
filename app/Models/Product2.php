<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product2 extends Model
{
    use HasFactory;

    protected $table = 'products2';

    public $timestamps = false;

    protected $fillable = [
        'articul',
        'code',
        'image',
        'parent_id',
        'description',
        'quality_id',
        'room_id',
        'changed',
//        'created_at',
//        'updated_at',
    ];
}
