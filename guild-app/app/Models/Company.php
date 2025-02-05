<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
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
}
