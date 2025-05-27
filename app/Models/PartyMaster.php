<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartyMaster extends Model
{
    use HasFactory;

    protected $table = 'party_master';
    protected $primaryKey = 'party_id';

    protected $fillable = [
        'party_name',
        'party_type',
        'address',
        'contact_number',
        'contact_person',
        'gst_number'
    ];
} 