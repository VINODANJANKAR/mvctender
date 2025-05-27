<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenderTransactionTbl extends Model
{
    use HasFactory;
    protected $table = 'tender_contractor_trancsaction_tbl';

    protected $fillable = [
        'tender_id',
        'contractor_id',
        'tender_fee',
        'emd_amount',
        'paid_by',
        'created_at',
        'updated_at',
        'emd_amount_refund'
    ];

    // protected $casts = [
    //     'tender_date' => 'date',
    //     'tender_opening_date' => 'date',
    //     'tender_closing_date' => 'date',
    //     'estimated_cost' => 'decimal:2',
    //     'security_deposit' => 'decimal:2'
    // ];

    // public function department()
    // {
    //     return $this->belongsTo(DepartmentMaster::class, 'department_id');
    // }

    // public function workOrders()
    // {
    //     return $this->hasMany(WorkOrderEntry::class, 'tender_id');
    // }

        // Inverse relationship with TenderEntries
        public function tender()
        {
            return $this->belongsTo(TenderEntry::class, 'tender_id', 'id');
        }
} 