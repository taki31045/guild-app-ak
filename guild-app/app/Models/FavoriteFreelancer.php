<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FavoriteFreelancer extends Model
{
    public function freelancer(){ 
        return $this->belongsTo(Freelancer::class);
    }

    public function company(){
        return $this->belongsTo(Company::class, 'freelancer_id');
    }
}
