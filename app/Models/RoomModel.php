<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomModel extends Model
{
    use HasFactory;

    protected $table = 'rooms';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'image',
        'created_date',
        'update_date',
    ];
}
