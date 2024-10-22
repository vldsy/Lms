<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        /*
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            // title
            // description
            // start_date
            // end_date
            $table->timestamps();
        });

        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            // user_id (FK)
            // course_id (FK)
            // enrollment_date
            // end_date
            $table->timestamps();
        });

        // materials

        // assignments

        // submissions

        // grades

        // announcements
        */
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        /*
        Schema::dropIfExists('courses');
        */
    }
};
