<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sender = DB::table('users')->first();
        $receiver = DB::table('users')->skip(1)->first();

        if ($sender && $receiver) {
            DB::table('messages')->insert([
                'sender_id' => $sender->id,
                'receiver_id' => $receiver->id,
                'content' => 'Hello! Are you available for a project?',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
