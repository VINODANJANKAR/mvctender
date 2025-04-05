<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkOrderEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'sr_no',
        'entry_date',
        'entry_year',
        'department_id',
        'tender_id',
        'contractor_id',
        'subcontractor_id',
        'work_done_by',
        'agreement_no',
        'work_order_no',
        'work_order_date',
        'work_order_amount',
        'work_time_limit',
        'dlp_period',
        'security_deposit',
        'additional_security_deposit'
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

    public function contractor()
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
} 