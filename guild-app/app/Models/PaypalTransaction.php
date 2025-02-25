<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaypalTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_id',
        'transaction_id',
        'amount',
        'currency',
        'status',
        'paypal_response',
    ];

    protected $casts = [
        'paypal_response' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
