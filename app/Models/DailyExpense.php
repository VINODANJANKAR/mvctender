<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyExpense extends Model
{
    use HasFactory;

    protected $table = 'daily_expenses';

    protected $fillable = [
        'date',
        'voucher_no',
        'ac_head_id',
        'party_id',
        'description',
        'amount',
        'payment_mode',
        'reference_no',
        'remark'
    ];

    protected $casts = [
        'date' => 'date',
        'amount' => 'decimal:2'
    ];

    public function accountHead()
    {
        return $this->belongsTo(AccountHeadMaster::class, 'ac_head_id');
    }

    public function party()
    {
        return $this->belongsTo(PartyMaster::class, 'party_id');
    }
} 