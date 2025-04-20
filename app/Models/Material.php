<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $fillable = [
        'party_id',
        'entry_no',
        'entry_date',
        'challan_no',
        'challan_date',
        'material_name',
        'quantity',
        'unit',
        'rate',
        'amount',
        'site_code',
        'name_of_work'
    ];

    protected $casts = [
        'entry_date' => 'date',
        'challan_date' => 'date',
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