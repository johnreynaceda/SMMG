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
        Schema::create('checkups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_appointment_id');
            $table->string('blood_pressure')->nullable();
            $table->string('bp_attachment')->nullable();
            $table->string('heart_rate')->nullable();
            $table->string('hr_attachment')->nullable();
            $table->boolean('blood_is_collected')->nullable();
            $table->string('bsc_attachment')->nullable();
            $table->longText('prescription')->nullable();
            $table->longText('other_information')->nullable();
            $table->string('status')->default('done');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checkups');
    }
};