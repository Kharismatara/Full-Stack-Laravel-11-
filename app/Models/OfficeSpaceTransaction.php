<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OfficeSpaceTransaction extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'phone_number',
        'booking_trx_id',
        'is_paid',
        'statrted_at',
        'total_amount',
        'duration',
        'ended_at',
        'office_space_id',
        
        

    ];
}