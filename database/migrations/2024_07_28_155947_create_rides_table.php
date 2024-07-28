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
        Schema::create('rides', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_car_id')->constrained()->onDelete('cascade');
            $table->date('created_on');
            $table->date('travel_start_time');
            $table->foreignId('source_municipio_id')->constrained('municipios');
            $table->foreignId('destination_municipio_id')->constrained('municipios');
            $table->integer('seats_offered');
            $table->decimal('contribution_per_head', 8, 2);
            $table->foreignId('luggage_size_id')->constrained();
            $table->boolean('is_recurring');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rides');
    }
};
