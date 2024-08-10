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
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->string('item_metindo');
            $table->string('item_customer');
            $table->string('partid_metindo');
            $table->string('partid_customer');
            $table->string('qty_metindo');
            $table->string('qty_customer');
            $table->string('status_metindo');
            $table->string('status_customer');
            $table->enum('hasil', ["OK", "NG"]);
            $table->dateTime('my_date');
            $table->string('jobno_metindo')->nullable();
            $table->string('jobno_customer')->nullable();
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};
