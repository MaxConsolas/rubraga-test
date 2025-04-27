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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('room_id')->constrained();
            $table->unsignedBigInteger('user_id')->constrained()->comment('Пользователь, совершивший бронь');
            $table->date('check_in_date')->comment('Дата заселения');
            $table->date('check_out_date')->comment('Дата выселения');
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
