<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('qr_tickets', function (Blueprint $table) {
            if (! Schema::hasColumn('qr_tickets', 'checked_in_at')) {
                $table->timestamp('checked_in_at')->nullable()->after('status');
            }

            if (! Schema::hasColumn('qr_tickets', 'checked_in_by')) {
                $table->foreignId('checked_in_by')->nullable()->after('checked_in_at')->constrained('users')->nullOnDelete();
            }
        });
    }

    public function down(): void
    {
        Schema::table('qr_tickets', function (Blueprint $table) {
            if (Schema::hasColumn('qr_tickets', 'checked_in_by')) {
                $table->dropConstrainedForeignId('checked_in_by');
            }

            if (Schema::hasColumn('qr_tickets', 'checked_in_at')) {
                $table->dropColumn('checked_in_at');
            }
        });
    }
};