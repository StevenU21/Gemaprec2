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
        Schema::create('maintenances', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->string('description');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('observations');
            $table->enum('status', ['pending', 'in_progress', 'completed'])->default('pending');

            $table->integer('computer_id')->unsigned();
            $table->foreign('computer_id')->references('id')->on('computers')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('maintenance_type_id')->unsigned();
            $table->foreign('maintenance_type_id')->references('id')->on('maintenance_types')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenances');
    }
};
