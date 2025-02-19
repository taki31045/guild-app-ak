<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class TransactionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $payer = DB::table('users')->where('role_id', 2)->first();
        $payee = DB::table('users')->where('role_id', 3)->first();

        if ($payer && $payee) {
            DB::table('transactions')->insert([
                'payer_id' => $payer->id,
                'payee_id' => $payee->id,
                'project_id' => 1,
                'amount' => 1500.00,
                'fee' => 50.00,
                'type' => 'freelancer_payment',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
