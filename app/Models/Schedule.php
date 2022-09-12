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
        'end',
        'comment',

    ];
    public function slot()
    {
       return $this->hasMany(Slot::class,'schedule_id');
    }
    public function doctor()
    {
        return $this->belongsTo(Doctor::class,'doctor_id');
    }
    
}