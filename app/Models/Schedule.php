<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $table="schedules";
    protected $fillable =[
        'status',
        'start',
        'interval',
        'number_of_people',
        'end',
        'comment',
        'doctor_id',
        'price'

    ];
    public function appointments()
    {
       return $this->belongsTo(Appointment::class,'slot_id','id');
    }
    public function doctor()
    {
        return $this->belongsTo(Doctor::class,'doctor_id');
    }

}
