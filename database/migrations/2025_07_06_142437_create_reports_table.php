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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->string('modification')->nullable()->comment('New_Report1,modification_report2');
            $table->string('folder_path')->nullable();
            $table->string('name');
            $table->string('header')->nullable();
            $table->string('type_date')->nullable()->comment('Cumulative1,specificDate2');
            $table->string('reson_request')->nullable()->comment('Internal1,Central_Banks2,Board3,Regulatory4');
            $table->string('status')->default('2')->comment('delivered1,awaiting_confirmation2,rejected3');
            $table->text('notes')->nullable();
            $table->date('date_from')->nullable();
            $table->date('date_to')->nullable();
            $table->date('date')->nullable();
            $table->date('closed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
