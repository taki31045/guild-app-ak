<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'payer_id', 'payee_id', 'amount', 'fee', 'type', 'project_id',
        'order_id', 'transaction_id', 'currency', 'status'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    protected $casts = [
        'paypal_response' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payee()
    {
        return $this->belongsTo(User::class, 'payee_id');
    }

    // protected static function boot()
    // {
    //     parent::boot();

    //     static::created(function () {
    //         Admin::first()->updateFinancials();
    //     });

    //     static::updated(function () {
    //         Admin::first()->updateFinancials();
    //     });

    //     static::deleted(function () {
    //         Admin::first()->updateFinancials();
    //     });
    // }
}


