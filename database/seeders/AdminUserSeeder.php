<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        // إنشاء الأدوار
        $roles = ['super_admin', 'admin', 'government', 'investor', 'user'];
        
        foreach ($roles as $roleName) {
            Role::firstOrCreate(['name' => $roleName]);
        }

        // قائمة المستخدمين
        $users = [
            [
                'name' => 'سوبر أدمن',
                'email' => 'superadmin@aabsher.tech',
                'password' => 'password',
                'role' => 'super_admin',
            ],
            [
                'name' => 'مدير النظام',
                'email' => 'admin@aabsher.tech',
                'password' => 'password',
                'role' => 'admin',
            ],
            [
                'name' => 'الجهة الحكومية',
                'email' => 'government@aabsher.tech',
                'password' => 'password',
                'role' => 'government',
            ],
            [
                'name' => 'المستثمر',
                'email' => 'investor@aabsher.tech',
                'password' => 'password',
                'role' => 'investor',
            ],
            [
                'name' => 'مستخدم عادي',
                'email' => 'user@aabsher.tech',
                'password' => 'password',
                'role' => 'user',
            ],
        ];

        foreach ($users as $userData) {
            $user = User::firstOrCreate(
                ['email' => $userData['email']],
                [
                    'name' => $userData['name'],
                    'password' => Hash::make($userData['password']),
                ]
            );

            // تعيين الدور
            if (!$user->hasRole($userData['role'])) {
                $user->assignRole($userData['role']);
            }
        }
    }
}
