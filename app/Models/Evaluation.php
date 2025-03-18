<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected $fillable = [
        'quality',
        'communication',
        'adherence',
        'total',
        'freelancer_id',
        'company_id',
        'project_id'
    ];
    
    public function freelancer(){
        return $this->belongsTo(Freelancer::class);
    }
}
