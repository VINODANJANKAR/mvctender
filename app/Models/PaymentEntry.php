<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentEntry extends Model
{
    use HasFactory;

    protected $table = 'payment_entries';

    protected $fillable = [
        'date',
        'paid_to',
        'description',
        'amount',
        'gst_amount',
        'total_amount',
        'payment_mode',
        'beneficiary_name',
        'partner_id',
        'bank_name',
        'bank_ac_name'
    ];

    protected $casts = [
        'date' => 'date',
        'amount' => 'decimal:2',
        'gst_amount' => 'decimal:2',
        'total_amount' => 'decimal:2'
    ];

    public function partner()
    {
        return $this->belongsTo(PartnerMaster::class, 'partner_id');
    }
} 