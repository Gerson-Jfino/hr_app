<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function employee()
    {
        return $this->hasOne(\App\Employee::class, 'user_id');
    }
    public function personal_data()
    {
        return $this->hasOne(\App\PersonalData::class, 'user_id');
    }
    public function nivel_academico()
    {
        return $this->hasOne(\App\NivelAcademico::class, 'user_id');
    }
}
