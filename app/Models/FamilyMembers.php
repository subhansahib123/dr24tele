<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyMembers extends Model
{
    use HasFactory;
    protected $table='family_members';
    protected $fillable=[
        'name',
        'email',
        'relation',
        'phone_number',
        'patient_id',
    ];
    public function patient()
    {
        return $this->belongsTo(Patient::class,'patient_id');
    }
}
