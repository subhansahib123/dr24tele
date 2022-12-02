<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EprescriptionDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'medicine',
        'morning',
        'after_noon',
        'evening',
        'comment',
        'eprescription_id'
    ];

    public function eprescription()
    {
        return $this->belongsTo(Eprescription::class,'eprescription_id');
    }


}
