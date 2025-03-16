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
            $table->integer('rank')->default(1); // Freelancer rank
            $table->integer('rank_point')->default(0); // Points for rank-up
            $table->string('github')->nullable();
            $table->string('X')->nullable();
            $table->string('instagram')->nullable();
            $table->string('facebook')->nullable();
            $table->decimal('total_earnings', 10, 2)->default(0);
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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('freelancers');
        Schema::enableForeignKeyConstraints();
    }
};
