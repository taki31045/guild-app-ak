<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    public function freelancers(){
        return $this->belongsToMany(Freelancer::class, 'freelancer_skills');
    }
}
