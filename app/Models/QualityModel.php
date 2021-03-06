<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QualityModel extends Model
{
    use HasFactory;

    protected $table = 'qualities';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'image',
        'price',
        'changed',
//        'created_at',
//        'updated_at',
    ];
}
