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
        'voucher_no',
        'party_id',
        'payment_type',
        'amount',
        'payment_mode',
        'reference_no',
        'description'
    ];

    protected $casts = [
        'date' => 'date',
        'amount' => 'decimal:2'
    ];

    public function party()
    {
        return $this->belongsTo(Party::class, 'party_id', 'party_id');
    }
} 