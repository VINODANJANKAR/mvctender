<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartmentMaster extends Model
{
    use HasFactory;

    protected $table = 'department_master';
    protected $primaryKey = 'department_id';

    protected $fillable = [
        'department_name',
        'department_code',
        'description',
        'gst_number',
        'tan_number',
        'pan_number'
    ];
} 