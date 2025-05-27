<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkDoneBy extends Model
{
    //
    protected $table = 'work_done_by';

    protected $fillable = [
        'work_order_id',
        'partner_id',
       
    ];
}
