<?php

use App\Models\Company;
use App\Models\Enquiry;
use App\Models\Event;
use App\Models\TicketType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Company::class)
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignIdFor(Event::class)
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignIdFor(TicketType::class)
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->foreignIdFor(Enquiry::class)
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->string('booking_code')->unique();

            $table->string('customer_name')->nullable();
            $table->string('customer_phone')->nullable();
            $table->string('customer_email')->nullable();

            $table->integer('quantity')->default(1);
            $table->decimal('unit_price', 10, 2)->default(0);
            $table->decimal('total_amount', 10, 2)->default(0);

            $table->string('status')->default('confirmed');
            // pending, confirmed, cancelled

            $table->string('payment_status')->default('manual_pending');
            // manual_pending, paid, unpaid, refunded

            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};