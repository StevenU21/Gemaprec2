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
        Schema::create('activities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description');
            $table->date('start_date');
            $table->date('end_date');

            $table->integer('activity_type_id')->unsigned();
            $table->foreign('activity_type_id')->references('id')->on('activity_types')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('maintenance_id')->unsigned();
            $table->foreign('maintenance_id')->references('id')->on('maintenances')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
