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
        Schema::create('trains', function (Blueprint $table) {
            $table->id();
            $table->string('company', 20);
            $table->string('departure_station', 50)->nullable();
            $table->string('arrival_station', 50)->nullable()->default('Pisa S.Rossore');
            $table->dateTimeTz('departure_time')->nullable();
            $table->dateTimeTz('arrival_time')->nullable();
            $table->string('train_code', 10);
            $table->tinyInteger('number_of_carriages')->nullable()->default(2);
            $table->tinyInteger('on_time')->nullable()->default(0);
            $table->boolean('cancelled')->nullable();
            /* $table->date('created_at')->nullable(); */
            /* $table->date('update_at')->nullable(); */
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trains');
    }
};
