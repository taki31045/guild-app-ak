<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'description',
        'required_rank',
        'deadline',
        'reward_amount',
        'status',
        'company_id'
    ];

    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function application(){
        return $this->hasOne(Application::class);
    }

    public function evaluation(){
        return $this->hasOne(Evaluation::class);
    }

    public function skills(){
        return $this->belongsToMany(Skill::class, 'project_skills', 'project_id', 'skill_id')->withTimestamps();
    }

    public function comments(){
        return $this->hasMany(ProjectComment::class);
    }

    public function isFavorited(){
        return auth()->user() ? auth()->user()->favoriteProjects->contains($this->id) : false;
    }

    public function favoriteProjects(){
        return $this->belongsToMany(User::class, 'favorite_projects', 'project_id', 'user_id')->withTimestamps();
    }



}
