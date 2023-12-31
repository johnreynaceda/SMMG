<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('patient_appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('doctor_id');
            $table->longText('condition');
            $table->dateTime('appointment_date');
            $table->foreignId('specialization_id');
            $table->string('status')->default('pending');
            $table->boolean('is_rescheduled')->default(false);
            $table->longText('reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_appointments');
    }
};