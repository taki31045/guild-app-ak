<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FreelancerSkill extends Model
{
    protected $table = 'freelancer_skills';
    protected $fillable = ['freelancer_id', 'skill_id'];

    public function freelancer(){
        return $this->belongsTo(Freelancer::class);
    }

    public function skill(){
        return $this->belongsTo(Skill::class);
    }
}
