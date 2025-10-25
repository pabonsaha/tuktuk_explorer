<?php

use App\Models\Tour;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tour_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(tour::class)->constrained()->onDelete('cascade');
            $table->string('duration')->nullable();
            $table->integer('num_of_people')->default(0);
            $table->double('price')->default(0.00);
            $table->integer('is_active')->default(1);


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour_prices');
    }
};
