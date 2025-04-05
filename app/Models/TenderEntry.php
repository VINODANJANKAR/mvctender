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
        'estimated_cost',
        'security_deposit',
        'tender_opening_date',
        'tender_closing_date',
        'remarks'
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

    public function workOrders()
    {
        return $this->hasMany(WorkOrderEntry::class, 'tender_id');
    }
} 