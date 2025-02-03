<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('freelancers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->integer('rank')->default(0); // Freelancer rank
            $table->integer('rank_point')->default(0); // Points for rank-up
            $table->string('github');
            $table->string('X');
            $table->string('instagram');
            $table->string('facebook');
            $table->decimal('total_earnings', 10, 2);
            $table->decimal('avg_evaluation', 3, 2); // Overall rating
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('freelancers');
    }
};
