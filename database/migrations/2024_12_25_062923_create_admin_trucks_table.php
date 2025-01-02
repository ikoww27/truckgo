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
        Schema::create('admin_trucks', function (Blueprint $table) {
            $table->id();
            $table->string('truck_id');
            $table->string('goods');
            $table->string('destination');
            $table->double('lat'); 
            $table->double('long'); 
            $table->string('next_destination');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_trucks');
    }
};
