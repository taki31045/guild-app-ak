<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

<<<<<<< HEAD
=======
    const ADMIN_ROLE_ID = 1;
    const COMPANY_ROLE_ID =2;
    const FREELANCER_ROLE_ID =3;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
>>>>>>> upstream/main
    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
        'role_id', // role_id を追加
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
