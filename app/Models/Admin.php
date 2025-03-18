<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Admin extends Model
{
    use SoftDeletes;

    protected $fillable = ['balance', 'total_fee_revenue', 'escrow_balance'];

    // public function updateFinancials()
    // {
    //     // 手数料収入の合計
    //     $totalFeeRevenue = Transaction::sum('fee');;

    //     // エスクローの残高
    //     $escrowDeposits = Transaction::where('type', 'escrow_deposit')->sum('amount');
    //     $escrowPayments = Transaction::where('type', 'payment')->sum('amount');
    //     $escrowBalance = $escrowDeposits - $escrowPayments;

    //     // 総資産（balance） = total_fee_revenue + escrow_balance
    //     $balance = $totalFeeRevenue + $escrowBalance;

    //     // データベースを更新
    //     $this->update([
    //         'total_fee_revenue' => $totalFeeRevenue,
    //         'escrow_balance' => $escrowBalance,
    //         'balance' => $balance
    //     ]);
    // }
}
