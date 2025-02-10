<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FavoriteProject extends Model
{
    protected $table = 'favorite_projects';

    protected $fillable = [
        'user_id',
        'project_id'
    ];

}
