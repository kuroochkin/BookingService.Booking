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
            $table->date('booking_date');
            $table->date('start_date');
            $table->date('end_date');
            $table->boolean('booking_status');
            $table->foreignId('tenant_id')->unsigned();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
