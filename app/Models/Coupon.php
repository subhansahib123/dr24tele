<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $fillable=[
        'title',
        'start_date',
        'end_date',
        'status',
        'organization_id',
        'created_by',
        'uuid',
        'discount'
    ];
}
