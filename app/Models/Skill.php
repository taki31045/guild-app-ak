<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = ['name'];

    public function freelancers(){
        return $this->belongsToMany(Freelancer::class, 'freelancer_skills', 'skill_id', 'freelancer_id')->withTimestamps();
    }

    public function projects(){
        return $this->belongsToMany(Project::class, 'project_skills', 'skill_id', 'project_id')->withTimestamps();
    }
}
