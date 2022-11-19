<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table="users";
    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
        'phone_number',
        'status',
        'uuid',
        'PersonId',
        'PersonUuid',
        'device_key',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function patient()
    {
       return $this->hasOne(Patient::class,'user_id');
    }
    public function doctor()
    {
       return $this->hasOne(Doctor::class,'user_id');
    }
    public function user_role()
    {
       return $this->hasOne(User_Role::class,'user_id');
    }
    public function appointment()
    {
       return $this->hasOne(Appointment::class,'doctor_id');
    }
    public function user_organization()
    {
       return $this->hasOne(UsersOrganization::class,'user_id');
    }
}
