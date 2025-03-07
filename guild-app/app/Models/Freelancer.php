<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Freelancer extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'rank',
        'rank_point',
        'github',
        'X',
        'instagram',
        'facebook',
        'total_earnings',
        'avg_evaluation'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id')->withTrashed();
    }

    public function skills(){
        return $this->belongsToMany(Skill::class, 'freelancer_skills', 'freelancer_id', 'skill_id')->withTimestamps();
    }

    public function evaluations(){
        return $this->hasMany(Evaluation::class);
    }

    public function applications(){
        return $this->hasMany(Application::class);
    }
    public function favoriteByCompany()
    {
        return $this->belongsToMany(Company::class, 'favorite_freelancers', 'freelancer_id', 'company_id');
    }
    

}
