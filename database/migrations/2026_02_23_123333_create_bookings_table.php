<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('phone');
            $table->integer('hours');
            $table->boolean('has_skates')->default(false);
            $table->foreignId('skate_id')->nullable()->constrained()->nullOnDelete();
            $table->integer('skate_size')->nullable();
            $table->integer('total_amount');
            $table->string('payment_id')->nullable();
            $table->string('payment_status')->default('pending');
            $table->boolean('is_paid')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};