<?php

use App\Models\Booking;
use App\Models\Event;
use App\Models\TicketType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('qr_tickets', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Booking::class)
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignIdFor(Event::class)
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignIdFor(TicketType::class)
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->string('ticket_code')->unique();
            $table->string('holder_name')->nullable();

            $table->string('status')->default('valid');
            // valid, checked_in, cancelled

            $table->timestamp('checked_in_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('qr_tickets');
    }
};