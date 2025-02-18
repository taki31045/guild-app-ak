<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'address',
        'website',
        'paypal_account',
        'total_spent'
    ];

    public function user(){
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function projects(){
        return $this->hasMany(Project::class);
    }

    public function favoriteFreelancers(){
        return $this->hasMany(FavoriteFreelancer::class);
    }
}
