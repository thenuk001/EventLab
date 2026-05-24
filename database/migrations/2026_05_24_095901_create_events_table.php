<?php

use App\Models\Category;
use App\Models\Company;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Company::class)
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignIdFor(Category::class)
                ->constrained()
                ->restrictOnDelete();

            $table->string('title');
            $table->string('slug')->unique();
            $table->string('event_code')->unique();
            $table->text('description')->nullable();

            $table->date('event_date');
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();

            $table->string('venue')->nullable();
            $table->string('city')->nullable();
            $table->text('map_url')->nullable();

            $table->string('poster')->nullable();
            $table->string('banner')->nullable();

            $table->string('status')->default('draft');
            $table->string('approval_status')->default('pending');
            $table->boolean('is_featured')->default(false);

            $table->unsignedBigInteger('views_count')->default(0);
            $table->unsignedBigInteger('whatsapp_clicks_count')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
