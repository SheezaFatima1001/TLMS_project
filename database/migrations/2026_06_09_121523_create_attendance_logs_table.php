<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('attendance_logs', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Links to User/Employee
        $table->date('date');
        $table->time('clock_in')->nullable();
        $table->time('clock_out')->nullable();
        $table->integer('hours_worked')->default(0); // In minutes or hours
        $table->string('status')->default('Absent'); // Present, Absent, On Leave
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance_logs');
    }
};
