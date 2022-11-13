<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientCoupon extends Model
{
    use HasFactory;
    protected $fillable=[
        'organization_id',
        'patienet_id',
        'coupon_id',
        'used_date'
    ];
}
