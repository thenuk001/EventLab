<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement('ALTER TABLE companies DROP CONSTRAINT IF EXISTS companies_status_check');

        DB::statement("
            ALTER TABLE companies
            ADD CONSTRAINT companies_status_check
            CHECK (status IN ('active', 'inactive', 'blocked'))
        ");

        DB::statement('ALTER TABLE companies DROP CONSTRAINT IF EXISTS companies_approval_status_check');

        DB::statement("
            ALTER TABLE companies
            ADD CONSTRAINT companies_approval_status_check
            CHECK (approval_status IN ('pending', 'approved', 'rejected'))
        ");
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE companies DROP CONSTRAINT IF EXISTS companies_status_check');

        DB::statement("
            ALTER TABLE companies
            ADD CONSTRAINT companies_status_check
            CHECK (status IN ('active', 'inactive'))
        ");

        DB::statement('ALTER TABLE companies DROP CONSTRAINT IF EXISTS companies_approval_status_check');

        DB::statement("
            ALTER TABLE companies
            ADD CONSTRAINT companies_approval_status_check
            CHECK (approval_status IN ('pending', 'approved', 'rejected'))
        ");
    }
};