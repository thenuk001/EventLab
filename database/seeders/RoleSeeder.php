<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $superAdminRole = Role::firstOrCreate(['name' => 'super_admin']);
        $companyAdminRole = Role::firstOrCreate(['name' => 'company_admin']);
        $supportStaffRole = Role::firstOrCreate(['name' => 'support_staff']);

        $superAdmin = User::firstOrCreate(
            ['email' => 'superadmin@eventlab.test'],
            [
                'name' => 'EventLab Super Admin',
                'password' => Hash::make('password123'),
            ]
        );

        $superAdmin->assignRole($superAdminRole);

        $company = Company::firstOrCreate(
            ['slug' => 'demo-events'],
            [
                'name' => 'Demo Events Company',
                'contact_person' => 'Demo Manager',
                'email' => 'company@eventlab.test',
                'whatsapp_number' => '94771234567',
                'status' => 'active',
                'approval_status' => 'approved',
            ]
        );

        $companyAdmin = User::firstOrCreate(
            ['email' => 'companyadmin@eventlab.test'],
            [
                'name' => 'Demo Company Admin',
                'company_id' => $company->id,
                'password' => Hash::make('password123'),
            ]
        );

        $companyAdmin->assignRole($companyAdminRole);

        $supportStaff = User::firstOrCreate(
            ['email' => 'support@eventlab.test'],
            [
                'name' => 'Demo Support Staff',
                'company_id' => $company->id,
                'password' => Hash::make('password123'),
            ]
        );

        $supportStaff->assignRole($supportStaffRole);
    }
}