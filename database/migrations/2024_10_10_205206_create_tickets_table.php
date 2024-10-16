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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_title');
            $table->text('ticket_desc')->nullable();
            $table->string('ticket_image')->nullable();
            $table->unsignedBigInteger('ticket_cat_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('support_id')->nullable();
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->unsignedBigInteger('status_id');
            $table->string('degree')->nullable();
            $table->timestamp('close_ticket_at')->nullable();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('ticket_cat_id')->references('id')->on('catigories')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('support_id')->references('id')->on('supports')->onDelete('set null');
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('set null');
            $table->foreign('status_id')->references('id')->on('statuses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
