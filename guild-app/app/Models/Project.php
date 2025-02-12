<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Carbon\Carbon;

class Project extends Model
{
    use SoftDeletes;

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

    public function getFormattedDeadlineAttribute(){
        return 'by ' . Carbon::parse($this->deadline)->format('M');
    }

    public function transactions(){
        return $this->hasMany(Transaction::class, 'project_id');
    }

}
