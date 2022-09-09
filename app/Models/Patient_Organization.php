<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient_Organization extends Model
{
    use HasFactory;
    protected $table="patient_organizations";
    protected $fillable=[
        "registration_code",
        "status",
    ];
}
