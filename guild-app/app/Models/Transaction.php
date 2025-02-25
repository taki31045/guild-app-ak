<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['payer_id', 'payee_id', 'amount', 'fee', 'type', 'project_id'];
    
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}
