<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatalogModel extends Model
{
    use HasFactory;

    protected $table = 'products';

    public $timestamps = false;

    protected $fillable = [
        'code',
        'name',
        'articul',
        'image',
        'price',
        'parent_id',
        'description',
        'quality_id',
        'room_id',
        'changed',
//        'created_at',
//        'updated_at',
    ];
}
