<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $table="appointments";
    protected $fillable=[
        'start',
        'end',
        'description',

    ];
    public function user()
    {
        return $this->belongsTo(User::class,'doctor_id');
    }
    public function slot()
    {
        return $this->belongsTo(Slot::class,'slot_id');
    }
}
