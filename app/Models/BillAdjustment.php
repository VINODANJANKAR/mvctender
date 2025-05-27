<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillAdjustment extends Model
{
    use HasFactory;

    protected $table = 'bill_adjustments';

    protected $fillable = [
       "date","voucher_no","bank_name","account_number","beneficiary_name","name_of_ref_person","paid_by","rtgs_amt","commision_rate","net_amt","amt_received_from","amt_recevied_date","recevied_amount","description","remarks", 
    ];

    protected $casts = [
        'date' => 'date',
        'adjustment_amount' => 'decimal:2',
        'amt_recevied_date' => 'date'
    ];


} 