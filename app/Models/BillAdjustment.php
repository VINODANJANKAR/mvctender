<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillAdjustment extends Model
{
    use HasFactory;

    protected $table = 'bill_adjustments';

    protected $fillable = [
        'date',
        'voucher_no',
        'bill_detail_id',
        'adjustment_amount',
        'adjustment_type',
        'reason'
    ];

    protected $casts = [
        'date' => 'date',
        'adjustment_amount' => 'decimal:2'
    ];

    public function billDetail()
    {
        return $this->belongsTo(BillDetail::class, 'bill_detail_id');
    }
} 