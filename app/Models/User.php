<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable implements MustVerifyEmail
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


    public function admin(){
        return $this->hasOne(Admin::class)->withTrashed();
    }

    public function company(){
        return $this->hasOne(Company::class)->withTrashed();
    }

    public function freelancer(){
        return $this->hasOne(Freelancer::class)->withTrashed();
    }

    public function ProjectComments(){
        return $this->hasMany(ProjectComment::class);
    }

    public function favoriteProjects(){
        return $this->belongsToMany(Project::class, 'favorite_projects', 'user_id', 'project_id')->withTimestamps();
    }

    public function sentMessages(){
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function receiveMessages(){
        return $this->hasMany(Message::class, 'receiver_id');
    }


    public function favoriteFreelancers()
{
    return $this->belongsToMany(Freelancer::class, 'favorite_freelancers', 'company_id', 'freelancer_id');
}

}
