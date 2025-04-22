<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnitMaster extends Model
{
    protected $table = 'unit_masters';

    protected $fillable = [
        'unit_name'
    ];
}
