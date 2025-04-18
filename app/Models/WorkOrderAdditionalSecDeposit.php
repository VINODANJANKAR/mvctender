<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkOrderAdditionalSecDeposit extends Model
{
    //
    protected $table = 'work_order_additional_security_deposit';

    protected $fillable = [
        'work_order_id' ,
        'additional_security_deposit_fdr_no' ,
        'additional_security_deposit_fdr_amt',
        'additional_security_deposit_fdr_bank',
        'additional_security_deposit_paid_by',
        'created_at',
        'updated_at'
    ];

    public function workOrders(){
        return $this->belongsTo(WorkOrderEntry::class, 'work_order_id', 'id');
    }

}
