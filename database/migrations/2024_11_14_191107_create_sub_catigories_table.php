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
        Schema::create('sub_catigories', function (Blueprint $table) {
            $table->id();
            $table->string('sub_cat_name');
            $table->integer('degre')->default(0);
            $table->unsignedBigInteger('catigory_id');
            $table->timestamps();

            $table->foreign('catigory_id')->references('id')->on('catigories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_catigories');
    }
};
