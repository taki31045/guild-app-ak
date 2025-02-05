<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'freelancer_id',
        'project_id',
        'status'
    ];

    public function freelancer(){
        return $this->belongsTo(Freelancer::class);
    }

    public function project(){
        return $this->belongsTo(Project::class);
    }
}
