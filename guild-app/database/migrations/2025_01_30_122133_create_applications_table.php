<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // Freelancers applying for projects
    public function up(): void
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('freelancer_id');
            $table->unsignedBigInteger('project_id');
            $table->string('status'); // ('requested', 'accepted', 'rejected', 'ongoing', 'submitted', 'resulted' 'completed')
            $table->string('submission_path')->nullable(); // 提出ファイルのパス
            $table->timestamp('submitted_at')->nullable(); // 提出日時
            $table->timestamps();

            $table->foreign('freelancer_id')->references('id')->on('freelancers')->onDelete('cascade');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
