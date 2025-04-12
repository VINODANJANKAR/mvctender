<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenderEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'tender_no',
        'tender_date',
        'department_id',
        'work_description',
        'entry_year',
        'tender_id',
        'tender_amount',
        'work_order_amount',
        'remarks',
        'dlp_period',
        'work_time_limit',
        'days_months',
        'work_order_received'
    ];

    protected $casts = [
        'tender_date' => 'date',
        'tender_opening_date' => 'date',
        'tender_closing_date' => 'date',
        'estimated_cost' => 'decimal:2',
        'security_deposit' => 'decimal:2'
    ];

    public function department()
    {
        return $this->belongsTo(DepartmentMaster::class, 'department_id');
    }
    public function transactions()
    {
        return $this->hasMany(TenderTransactionTbl::class, 'tender_id', 'id');
    }

    public function workOrders()
    {
        return $this->hasMany(WorkOrderEntry::class, 'tender_id');
    }
} 