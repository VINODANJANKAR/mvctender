<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyExpense extends Model
{
    use HasFactory;

    protected $table = 'daily_expenses';

    protected $fillable = [
        'entry_no',
        'entry_date',
        'expense_date',
        'site_code',
        'name_of_work',
        'description',
        'paid_to',
        'payment_through',
        'amount',
        'payment_mode',
        'paid_by',
        'voucher_book_no',
        'voucher_no',
        'expense_type'
    ];

    protected $casts = [
        'entry_date' => 'date',
        'expense_date' => 'date',
        'amount' => 'decimal:2'
    ];

    public function partner()
    {
        return $this->belongsTo(PartnerMaster::class, 'paid_by');
    }
} 