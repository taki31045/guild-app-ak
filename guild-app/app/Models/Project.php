<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Carbon\Carbon;

class Project extends Model
{
    use SoftDeletes;

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
        return $this->hasOne(Application::class, 'project_id');
    }

    public function evaluation(){
        return $this->hasOne(Evaluation::class);
    }

    public function getFormattedDeadlineAttribute(){
        return 'by ' . Carbon::parse($this->deadline)->format('M');
    }

    public function transactions(){
        return $this->hasMany(Transaction::class, 'project_id');
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
