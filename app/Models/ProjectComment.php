<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectComment extends Model
{
    protected $table = 'project_comments';

    protected $fillable = [
        'content',
        'user_id',
        'project_id'
    ];

    public function project(){
        return $this->belongsTo(Project::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
