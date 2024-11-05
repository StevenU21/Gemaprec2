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
        Schema::create('computers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('serial_number');
            $table->string('mac_address');
            $table->string('adquisition_date');
            $table->string('status');

            $table->integer('brand_id')->unsigned();
            $table->foreign('brand_id')->references('id')->on('brands');

            $table->integer('pc_model_id')->unsigned();
            $table->foreign('pc_model_id')->references('id')->on('pc_models');

            $table->integer('ubications_id')->unsigned();
            $table->foreign('ubications_id')->references('id')->on('ubications');

            $table->integer('pc_type_id')->unsigned();
            $table->foreign('pc_type_id')->references('id')->on('pc_types');

            $table->integer('client_id')->nullable();
            $table->foreign('client_id')->references('id')->on('clients');

            $table->integer('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users');

            $table->integer('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('computers');
    }
};
