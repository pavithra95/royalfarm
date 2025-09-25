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
        Schema::create('variants', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->enum('status',['active','inactive']);
            $table->timestamps();
        });

         Schema::create('variant_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('variant_id');
            $table->string('name');
            $table->string('color')->nullable();
            $table->string('image')->nullable();
            $table->enum('status',['active','inactive']);
            $table->timestamps();

            $table->foreign('variant_id')->references('id')->on('variants')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variants');
    }
};
