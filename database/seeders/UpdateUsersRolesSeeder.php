<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

class UpdateUsersRolesSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('🔧 تحديث جدول المستخدمين...');
        
        // 1. تحديث enum للأدوار
        try {
            DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('user', 'government', 'investor', 'admin', 'super_admin') DEFAULT 'user'");
            $this->command->info('✅ تم تحديث أنواع الأدوار');
        } catch (\Exception $e) {
            $this->command->warn('⚠️ الأدوار موجودة مسبقاً');
        }
        
        // 2. إضافة الأعمدة الجديدة إذا لم تكن موجودة
        Schema::table('users', function ($table) {
            if (!Schema::hasColumn('users', 'avatar')) {
                $table->string('avatar')->nullable()->after('role');
                $this->command->info('✅ تم إضافة عمود avatar');
            }
            
            if (!Schema::hasColumn('users', 'organization')) {
                $table->string('organization')->nullable()->after('avatar');
                $this->command->info('✅ تم إضافة عمود organization');
            }
            
            if (!Schema::hasColumn('users', 'phone')) {
                $table->string('phone')->nullable()->after('organization');
                $this->command->info('✅ تم إضافة عمود phone');
            }
        });
        
        // 3. إنشاء/تحديث المستخدمين
        $this->createOrUpdateUsers();
        
        $this->command->info('🎉 تم الانتهاء بنجاح!');
        $this->displayUsers();
    }
    
    private function createOrUpdateUsers()
    {
        // مستخدم عادي
        User::updateOrCreate(
            ['email' => 'user@user.com'],
            [
                'name' => 'مستخدم عادي',
                'password' => bcrypt('password'),
                'role' => 'user',
                'phone' => '0509876543',
                'avatar' => 'https://ui-avatars.com/api/?name=User&background=3b82f6&color=fff&size=200'
            ]
        );
        $this->command->info('✅ مستخدم عادي: user@user.com');
        
        // جهة حكومية
        User::updateOrCreate(
            ['email' => 'gov@gov.sa'],
            [
                'name' => 'وزارة الشؤون البلدية',
                'password' => bcrypt('password'),
                'role' => 'government',
                'organization' => 'وزارة الشؤون البلدية والقروية',
                'phone' => '920000001',
                'avatar' => 'https://ui-avatars.com/api/?name=Gov&background=3b82f6&color=fff&size=200'
            ]
        );
        $this->command->info('✅ جهة حكومية: gov@gov.sa');
        
        // مستثمر
        User::updateOrCreate(
            ['email' => 'investor@invest.com'],
            [
                'name' => 'شركة التطوير العقاري',
                'password' => bcrypt('password'),
                'role' => 'investor',
                'organization' => 'مجموعة التطوير العقاري',
                'phone' => '920000002',
                'avatar' => 'https://ui-avatars.com/api/?name=Investor&background=8b5cf6&color=fff&size=200'
            ]
        );
        $this->command->info('✅ مستثمر: investor@invest.com');
        
        // أدمن
        User::updateOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'مدير النظام',
                'password' => bcrypt('password'),
                'role' => 'admin',
                'organization' => 'إدارة النظام',
                'phone' => '920000004',
                'avatar' => 'https://ui-avatars.com/api/?name=Admin&background=764ba2&color=fff&size=200'
            ]
        );
        $this->command->info('✅ أدمن: admin@admin.com');
        
        // سوبر أدمن
        User::updateOrCreate(
            ['email' => 'super@admin.com'],
            [
                'name' => 'المدير الرئيسي',
                'password' => bcrypt('password'),
                'role' => 'super_admin',
                'organization' => 'الإدارة العامة',
                'phone' => '920000003',
                'avatar' => 'https://ui-avatars.com/api/?name=Super+Admin&background=667eea&color=fff&size=200'
            ]
        );
        $this->command->info('✅ سوبر أدمن: super@admin.com');
    }
    
    private function displayUsers()
    {
        $this->command->info('');
        $this->command->info('📋 قائمة المستخدمين:');
        $this->command->info('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');
        
        $users = User::all(['name', 'email', 'role', 'organization']);
        
        foreach ($users as $user) {
            $roleEmoji = match($user->role) {
                'user' => '👤',
                'government' => '🏛️',
                'investor' => '💼',
                'admin' => '👨‍💼',
                'super_admin' => '👑',
                default => '❓'
            };
            
            $this->command->info(sprintf(
                '%s %-25s | %-30s | %s',
                $roleEmoji,
                $user->name,
                $user->email,
                $user->organization ?? 'لا يوجد'
            ));
        }
        
        $this->command->info('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');
        $this->command->info('🔑 كلمة المرور لجميع الحسابات: password');
    }
}
