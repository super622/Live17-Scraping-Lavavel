<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaseData extends Model
{
    use HasFactory;

    protected $table = 'base_settings';

    protected $fillable = [
        'reduced_price',
        'min_param_one',
        'min_param_two',
        'max_param_one'
    ];
}
