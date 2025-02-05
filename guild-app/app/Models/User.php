<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use SoftDeletes;

    const ADMIN_ROLE_ID = 1;
    const COMPANY_ROLE_ID = 2;
    const FREELANCER_ROLE_ID = 3;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
        'avatar',
        'role_id'
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


    public function company(){
        return $this->hasOne(Company::class)->withTrashed();
    }

    public function freelancer(){
        return $this->hasOne(Freelancer::class, 'user_id', 'id')->withTrashed();
    }
}
