<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class TermPaymentModel extends Model
{
    use HasFactory;

    protected $table = 'due_dates';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'active',
        'percent',
        'changed',
//        'created_at',
//        'update_at',
    ];

}
