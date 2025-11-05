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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('hour')->nullable();
            $table->integer('passengers')->nullable();
            $table->json('additionals')->nullable();
            $table->date('tour_date')->nullable();
            $table->string('tour_time')->nullable();
            $table->double('per_pessenger_price')->nullable();
            $table->double('passenger_price')->nullable();
            $table->double('total_price')->nullable();
            $table->string('currency')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('customer_email')->nullable();
            $table->string('customer_phone')->nullable();
            $table->string('customer_country')->nullable();
            $table->string('payment_customer_info')->nullable();
            $table->string('payment_invoice_id')->nullable();
            $table->string('payment_source')->nullable();
            $table->string('payment_status')->default('unpaid');
            $table->string('active_status')->default('1')->comment('0=inactive,1=active');
            $table->string('tour_status')->default('1')->comment('1=confirmed,2=complete,0=cancelled');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
