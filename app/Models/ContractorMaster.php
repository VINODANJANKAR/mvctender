<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContractorMaster extends Model
{
    //
    protected $table = 'contractor_masters';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'mobile_number',
        'address'
    ];
}
