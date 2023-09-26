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
        Schema::create('add_to_lists', function (Blueprint $table) {
            $table->id();
            $table->string('part_no');
            $table->string('nomenclature');
            $table->integer('qty')->default('1');
            $table->unsignedBigInteger('mission_id');
            $table->timestamps();


            $table->foreign('mission_id')->references('id')->on('missions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('add_to_lists');
    }
};
