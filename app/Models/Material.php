<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'voucher_no',
        'account_head_id',
        'party_id',
        'description',
        'quantity',
        'unit',
        'rate',
        'amount',
        'payment_mode',
        'reference_no',
        'remark'
    ];

    protected $casts = [
        'date' => 'date',
        'quantity' => 'decimal:2',
        'rate' => 'decimal:2',
        'amount' => 'decimal:2'
    ];

    public function accountHead()
    {
        return $this->belongsTo(AccountHeadMaster::class, 'account_head_id');
    }

    public function party()
    {
        return $this->belongsTo(PartyMaster::class, 'party_id');
    }
} 