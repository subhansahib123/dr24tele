<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorSpecialization extends Model
{
    use HasFactory;
    protected $table='doctor_specializations';
    protected $fillable=[
        'name'
    ];
    public function specializedDoctor()
    {
        return $this->belongsToMany(Doctor::class,'specialized_doctors','specialization_id','doctor_id');
    }
}

