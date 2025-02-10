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


    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

// >>>>>>> upstream/main



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
        return $this->hasOne(Freelancer::class)->withTrashed();
    }

    public function ProjectComments(){
        return $this->hasMany(ProjectComment::class);
    }

    public function favoriteProjects(){
        return $this->belongsToMany(Project::class, 'favorite_projects', 'user_id', 'project_id')->withTimestamps();
    }

}
