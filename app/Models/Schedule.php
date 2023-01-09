<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $table="schedules";
    const  DAYS = [
        [
            'label' => 'Monday',
            'value' => 'M',
        ],
        [
            'label' => 'Tuesday',
            'value' => 'T',
        ],
        [
            'label' => 'Wednesday',
            'value' => 'W',
        ],
        [
            'label' => 'Thursday',
            'value' => 'TH',
        ],
        [
            'label' => 'Friday',
            'value' => 'F',
        ],
        [
            'label' => 'Saturday',
            'value' => 'SA',
        ],
        [
            'label' => 'Sunday',
            'value' => 'S',
        ],
    ];
    protected $fillable =[
        'status',
        'start',
        'interval',
        'number_of_people',
        'end',
        'comment',
        'doctor_id',
        'price',
        'slot_id',
        'repeat',
        'days',
        'slot_belong'


    ];
    public function appointments()
    {
       return $this->belongsTo(Appointment::class,'slot_id','id');
    }
    public function doctor()
    {
        return $this->belongsTo(Doctor::class,'doctor_id');
    }
    public function getDAYSAttribute($value)
    {
        return collect(static::DAYS)->firstWhere('value', $this->days)['label'] ?? '';
    }

}
