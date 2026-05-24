<?php

use App\Models\Event;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ticket_types', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Event::class)
                ->constrained()
                ->cascadeOnDelete();

            $table->string('name');
            $table->decimal('price', 10, 2);
            $table->integer('quantity')->default(0);
            $table->integer('sold_count')->default(0);
            $table->text('benefits')->nullable();

            $table->string('availability_status')->default('available');
            // available, few_left, sold_out, coming_soon

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ticket_types');
    }
};