<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkOrderEntry extends Model
{
    use HasFactory;

    protected $table = 'work_order_entries';
    // protected $fillable = [
    //     'entry_date' ,
    //     'entry_year' ,
    //     'sr_no' ,
    //     'tender_id' ,
    //     'department_id' ,
    //     'contractor_id',
    //     'subcontractor_id',
    //     'agreement_no' ,
    //     'work_order_no' ,
    //     'work_order_date' ,
    //     'work_order_amount' ,
    //     'work_time_limit' ,
    //     'dlp_period' ,
    //     'security_deposite' ,
    //     'additional_security_deposit' ,
    //     'name_of_work' ,
    //     'work_head' ,
    //     'work_done_by',
    //     'bond_amount',
    //     'bond_amount_bank',
    //     'bond_amount_paid_by',
    //     'created_at',
    //     'updated_at'
    // ];
    protected $fillable = [
        'entry_date', 'entry_year', 'sr_no', 'tender_id',
        'agreement_no', 'department_id', 'contractor_id', 'subcontractor_id','work_order_no',
        'work_order_date', 'work_order_amount', 'work_time_limit',
        'dlp_period', 'security_deposite', 'additional_security_deposit','security_deposit_amount_refund','additional_security_deposit_amount_refund',
        'name_of_work', 'work_head', 'work_done_by','bond_amount','bond_amount_bank','bond_amount_paid_by','created_at', 'updated_at'
    ];

    protected $casts = [
        'entry_date' => 'date',
        'work_order_date' => 'date',
        'work_order_amount' => 'decimal:2',
        'security_deposit' => 'decimal:2',
        'additional_security_deposit' => 'decimal:2'
    ];

    public function department()
    {
        return $this->belongsTo(DepartmentMaster::class, 'department_id');
    }

    public function tender()
    {
        return $this->belongsTo(TenderEntry::class, 'tender_id');
    }

    public function parties()
    {
        return $this->belongsTo(PartyMaster::class, 'contractor_id');
    }

    public function subcontractor()
    {
        return $this->belongsTo(PartyMaster::class, 'subcontractor_id');
    }

    public function billDetails()
    {
        return $this->hasMany(BillDetail::class, 'work_order_id');
    }

    public function securityDeposite()
    {
        return $this->hasMany(WorkOrderSecDeposit::class, 'work_order_id');
    }
    public function addSecurityDeposite(){
        return $this->hasMany(WorkOrderAdditionalSecDeposit::class, 'work_order_id');
    }
    public function workDoneBy(){
        return $this->hasMany(workDoneBy::class, 'work_order_id');
    }
} 