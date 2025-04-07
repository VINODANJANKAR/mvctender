<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountHeadMaster extends Model
{
    use HasFactory;

    protected $table = 'account_head_master';
    protected $primaryKey = 'ac_head_id';

    protected $fillable = [
        'ac_head_name'
    ];
} 