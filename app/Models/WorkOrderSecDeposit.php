<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkOrderSecDeposit extends Model
{
    //

    protected $table = 'work_order_security_deposit';

    protected $fillable = [
        'work_order_id' ,
        'security_deposit_fdr_no' ,
        'security_deposit_fdr_date',
        'security_deposit_fdr_amt',
        'security_deposit_fdr_bank',
        'security_deposit_paid_by',
        'created_at',
        'updated_at'
    ];


    public function workOrders(){
        return $this->belongsTo(WorkOrderEntry::class, 'work_order_id', 'id');
    }
}
