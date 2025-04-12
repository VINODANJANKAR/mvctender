<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubContractorMaster extends Model
{
    //
    protected $table = 'sub_contractor_masters';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'mobile_number',
        'address',
        'contractor_id'
    ];


    public function contractor()
    {
        return $this->belongsTo(ContractorMaster::class, 'contractor_id', 'id');
    }

}
