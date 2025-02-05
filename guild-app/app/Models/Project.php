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

}
