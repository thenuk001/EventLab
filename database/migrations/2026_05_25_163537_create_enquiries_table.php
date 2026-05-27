<?php

use App\Models\Company;
use App\Models\Event;
use App\Models\TicketType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('enquiries', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Event::class)
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignIdFor(Company::class)
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignIdFor(TicketType::class)
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->string('customer_name')->nullable();
            $table->string('customer_phone')->nullable();
            $table->integer('quantity')->nullable();

            $table->string('cta_type')->default('book');
            $table->string('status')->default('new');

            $table->string('source_page')->nullable();
            $table->timestamp('clicked_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enquiries');
    }
};