<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecializedDoctor extends Model
{
    use HasFactory;
    protected $table="specialized_doctors";
    protected $fillable=[
        'specialization_id',
        'doctor_id',
    ];
    public function doctor()
    {
        return $this->belongsTo(Doctor::class,'doctor_id');
    }
    public function specialization()
    {
        return $this->belongsTo(DepartmentSpecializations::class,'specialization_id');
    }
}
