<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_code',
        'year',
        'date',
        'department_id',
        'contractor_id',
        'subcontractor_id',
        'name_of_work',
        'bank_name',
        'work_done_by',
        'agreement_no',
        'bill_no',
        'work_order_amount',
        'work_time_limit',
        'dlp_period',
        'total_bill_amount',
        'deduction_amount',
        'net_bill_amount',
        'security_deposit',
        'insurance',
        'gst',
        'surcharge',
        'cess',
        'tds',
        'royalty',
        'fine',
        'other',
        'bank_charges',
        'stamp_duty',
        'gram_panchayat_deduction',
        'gram_panchayat_emd',
        'remark'
    ];

    protected $casts = [
        'date' => 'date',
        'work_order_amount' => 'decimal:2',
        'total_bill_amount' => 'decimal:2',
        'deduction_amount' => 'decimal:2',
        'net_bill_amount' => 'decimal:2',
        'security_deposit' => 'decimal:2',
        'insurance' => 'decimal:2',
        'gst' => 'decimal:2',
        'surcharge' => 'decimal:2',
        'cess' => 'decimal:2',
        'tds' => 'decimal:2',
        'royalty' => 'decimal:2',
        'fine' => 'decimal:2',
        'other' => 'decimal:2',
        'bank_charges' => 'decimal:2',
        'stamp_duty' => 'decimal:2',
        'gram_panchayat_deduction' => 'decimal:2',
        'gram_panchayat_emd' => 'decimal:2'
    ];


} 