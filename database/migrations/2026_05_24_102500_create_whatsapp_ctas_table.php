<?php

use App\Models\Event;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('whatsapp_ctas', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Event::class)
                ->constrained()
                ->cascadeOnDelete();

            $table->string('booking_number');
            $table->string('support_number')->nullable();
            $table->string('cta_label')->default('Book on WhatsApp');
            $table->text('template_message');
            $table->string('qr_code_path')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('whatsapp_ctas');
    }
};