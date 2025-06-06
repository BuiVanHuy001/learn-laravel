<?php

    use App\Models\Job;
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
        Schema::create('jobs', static function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->text('description');
            $table->string('location');
            $table->enum('experience', Job::$experiences);
            $table->enum('category', Job::$categories);
            $table->unsignedInteger('salary');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
