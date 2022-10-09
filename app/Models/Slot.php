<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
    use HasFactory;
    protected $table="slots";
    protected $fillable=[
        'start',
        'end',
        'status',
        'schedule_id',
        'price'
    ];
    public function schedule()
    {
        return $this->belongsTo(Schedule::class,'schedule_id');
    }
    public function appointment()
    {
       return $this->hasOne(Appointment::class,'slot_id');
    }
}
