<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FavoriteFreelancer extends Model
{
    protected  $fillable = [
        'company_id',
        'freelancer_id'
    ];


    public function freelancer(){ 
        return $this->belongsTo(Freelancer::class);
    }

    public function company(){
        return $this->belongsTo(Company::class, 'freelancer_id');
    }
}
