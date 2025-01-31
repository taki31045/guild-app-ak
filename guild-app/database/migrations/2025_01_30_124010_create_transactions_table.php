<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // company → admin → freelancer or admin->company
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('payer_id'); // Company or Admin
            $table->unsignedBigInteger('payee_id'); // company or Freelancer
            $table->decimal('amount', 10, 2);
            $table->decimal('fee', 10, 2)->default(0.00); // Transaction fee
            $table->string('type'); //('escrow_deposit', 'freelancer_payment', 'refund')
            $table->timestamps();

            $table->foreign('payer_id')->references('id')->on('users');
            $table->foreign('payee_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
