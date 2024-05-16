<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'booking_date',
        'start_date',
        'end_date',
        'accommodation_id',
        'tenant_id',
        'booking_status',
    ];
}
