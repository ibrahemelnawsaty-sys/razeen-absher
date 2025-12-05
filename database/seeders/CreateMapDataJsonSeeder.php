<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CreateMapDataJsonSeeder extends Seeder
{
    public function run()
    {
        $dataPath = base_path('data');
        
        if (!File::exists($dataPath)) {
            File::makeDirectory($dataPath, 0755, true);
        }
        
        $this->command->info('📊 Creating comprehensive map data...');
        
        // 1. خدمات الطوارئ - بيانات غنية
        $this->createEmergencyServices($dataPath);
        
        // 2. الطرق - بيانات مفصلة
        $this->createRoadsData($dataPath);
        
        // 3. المشاريع البلدية
        $this->createMunicipalProjects($dataPath);
        
        // 4. كثافة المرور
        $this->createTrafficDensity($dataPath);
        
        // 5. فرق الصيانة
        $this->createMaintenanceTeams($dataPath);
        
        $this->command->info('✅ All data files created successfully!');
    }
    
    private function createEmergencyServices($dataPath)
    {
        $services = [
            // المستشفيات
            [
                'id' => 1,
                'name' => 'مستشفى الملك فهد الجامعي',
                'name_en' => 'King Fahd University Hospital',
                'type' => 'hospital',
                'address' => 'طريق الملك فهد، حي الياسمين، الرياض 11564',
                'phone' => '920012345',
                'emergency_phone' => '997',
                'lat' => 24.7236,
                'lng' => 46.6853,
                'is_open' => true,
                'working_hours' => '24 ساعة',
                'specialties' => ['طوارئ', 'جراحة', 'باطنية', 'أطفال'],
                'beds_count' => 520,
                'rating' => 4.5
            ],
            [
                'id' => 2,
                'name' => 'مستشفى الملك خالد الجامعي',
                'name_en' => 'King Khalid University Hospital',
                'type' => 'hospital',
                'address' => 'طريق الملك عبدالعزيز، حي المربع، الرياض',
                'phone' => '920023456',
                'emergency_phone' => '997',
                'lat' => 24.7136,
                'lng' => 46.6753,
                'is_open' => true,
                'working_hours' => '24 ساعة',
                'specialties' => ['طوارئ', 'قلب', 'عظام', 'أعصاب'],
                'beds_count' => 850,
                'rating' => 4.7
            ],
            [
                'id' => 3,
                'name' => 'مستشفى الحرس الوطني',
                'name_en' => 'National Guard Hospital',
                'type' => 'hospital',
                'address' => 'طريق الملك عبدالعزيز، الرياض',
                'phone' => '920034567',
                'emergency_phone' => '997',
                'lat' => 24.7450,
                'lng' => 46.6580,
                'is_open' => true,
                'working_hours' => '24 ساعة',
                'specialties' => ['طوارئ', 'جراحة', 'نساء وولادة'],
                'beds_count' => 1200,
                'rating' => 4.8
            ],
            [
                'id' => 4,
                'name' => 'مركز الإسعاف الرئيسي',
                'name_en' => 'Main Ambulance Center',
                'type' => 'ambulance',
                'address' => 'شارع العليا، حي العليا، الرياض',
                'phone' => '997',
                'emergency_phone' => '997',
                'lat' => 24.7036,
                'lng' => 46.6653,
                'is_open' => true,
                'working_hours' => '24 ساعة',
                'ambulances_count' => 25,
                'rating' => 4.6
            ],
            [
                'id' => 5,
                'name' => 'مركز الإسعاف الشمالي',
                'name_en' => 'North Ambulance Center',
                'type' => 'ambulance',
                'address' => 'طريق الدائري الشمالي، الرياض',
                'phone' => '997',
                'emergency_phone' => '997',
                'lat' => 24.7850,
                'lng' => 46.6700,
                'is_open' => true,
                'working_hours' => '24 ساعة',
                'ambulances_count' => 15,
                'rating' => 4.4
            ],
            [
                'id' => 6,
                'name' => 'الدفاع المدني - المركز الرئيسي',
                'name_en' => 'Civil Defense - Main Center',
                'type' => 'fire_station',
                'address' => 'طريق الملك عبدالعزيز، حي المربع، الرياض',
                'phone' => '998',
                'emergency_phone' => '998',
                'lat' => 24.7336,
                'lng' => 46.6953,
                'is_open' => true,
                'working_hours' => '24 ساعة',
                'fire_trucks_count' => 12,
                'rating' => 4.9
            ],
            [
                'id' => 7,
                'name' => 'الدفاع المدني - شمال الرياض',
                'name_en' => 'Civil Defense - North Riyadh',
                'type' => 'fire_station',
                'address' => 'طريق الدائري الشمالي، الرياض',
                'phone' => '998',
                'emergency_phone' => '998',
                'lat' => 24.7800,
                'lng' => 46.6600,
                'is_open' => true,
                'working_hours' => '24 ساعة',
                'fire_trucks_count' => 8,
                'rating' => 4.7
            ],
            [
                'id' => 8,
                'name' => 'مركز شرطة النخيل',
                'name_en' => 'Al Nakheel Police Station',
                'type' => 'police',
                'address' => 'حي النخيل، شمال الرياض',
                'phone' => '989',
                'emergency_phone' => '911',
                'lat' => 24.7436,
                'lng' => 46.7053,
                'is_open' => true,
                'working_hours' => '24 ساعة',
                'officers_count' => 45,
                'rating' => 4.5
            ],
            [
                'id' => 9,
                'name' => 'مركز شرطة العليا',
                'name_en' => 'Olaya Police Station',
                'type' => 'police',
                'address' => 'شارع العليا، الرياض',
                'phone' => '989',
                'emergency_phone' => '911',
                'lat' => 24.7100,
                'lng' => 46.6750,
                'is_open' => true,
                'working_hours' => '24 ساعة',
                'officers_count' => 60,
                'rating' => 4.6
            ],
            [
                'id' => 10,
                'name' => 'مركز الأمن الشامل',
                'name_en' => 'Comprehensive Security Center',
                'type' => 'police',
                'address' => 'طريق الملك فهد، الرياض',
                'phone' => '911',
                'emergency_phone' => '911',
                'lat' => 24.7150,
                'lng' => 46.6850,
                'is_open' => true,
                'working_hours' => '24 ساعة',
                'officers_count' => 80,
                'rating' => 4.8
            ],
        ];
        
        File::put(
            $dataPath . '/riyadh_emergency_services.json',
            json_encode($services, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)
        );
        
        $this->command->info('   ✅ Created emergency services (' . count($services) . ' services)');
    }
    
    private function createRoadsData($dataPath)
    {
        $roads = [
            [
                'id' => 1,
                'name' => 'طريق الملك فهد',
                'name_en' => 'King Fahd Road',
                'status' => 'moderate',
                'speed' => 45,
                'incidents' => 2,
                'description' => 'حركة متوسطة مع بعض التباطؤ'
            ],
            [
                'id' => 2,
                'name' => 'طريق الملك عبدالله',
                'name_en' => 'King Abdullah Road',
                'status' => 'clear',
                'speed' => 80,
                'incidents' => 0,
                'description' => 'الطريق سالك بدون ازدحام'
            ],
            [
                'id' => 3,
                'name' => 'شارع العليا',
                'name_en' => 'Olaya Street',
                'status' => 'maintenance',
                'speed' => 30,
                'incidents' => 1,
                'description' => 'يوجد أعمال صيانة على الطريق'
            ],
            [
                'id' => 4,
                'name' => 'طريق الملك خالد',
                'name_en' => 'King Khalid Road',
                'status' => 'congested',
                'speed' => 15,
                'incidents' => 3,
                'description' => 'ازدحام شديد - يفضل اختيار طريق بديل'
            ],
        ];
        
        File::put(
            $dataPath . '/riyadh_roads.json',
            json_encode($roads, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)
        );
        
        $this->command->info('   ✅ Created roads data (' . count($roads) . ' roads)');
    }
    
    private function createMunicipalProjects($dataPath)
    {
        $projects = [
            [
                'id' => 1,
                'name' => 'مشروع تطوير طريق الملك فهد',
                'type' => 'road',
                'location' => 'من تقاطع العليا إلى حي الياسمين',
                'status' => 'in_progress',
                'contractor' => 'شركة بن لادن السعودية',
                'completion' => 65,
                'remaining' => '4 أشهر',
                'lat' => 24.7200,
                'lng' => 46.6800
            ],
            [
                'id' => 2,
                'name' => 'إنشاء حديقة الورود',
                'type' => 'park',
                'location' => 'حي الورود، شمال الرياض',
                'status' => 'completed',
                'contractor' => 'شركة العمران',
                'completion' => 85,
                'remaining' => '2 شهر',
                'lat' => 24.7400,
                'lng' => 46.7000
            ],
            [
                'id' => 3,
                'name' => 'صيانة شبكة الإنارة',
                'type' => 'lighting',
                'location' => 'طريق الملك خالد',
                'status' => 'in_progress',
                'contractor' => 'الشركة السعودية للكهرباء',
                'completion' => 40,
                'remaining' => '6 أشهر',
                'lat' => 24.7100,
                'lng' => 46.6700
            ]
        ];
        
        File::put(
            $dataPath . '/riyadh_municipal_projects.json',
            json_encode($projects, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)
        );
        
        $this->command->info('   ✅ Created municipal projects (' . count($projects) . ' projects)');
    }
    
    private function createTrafficDensity($dataPath)
    {
        $trafficData = [];
        
        File::put(
            $dataPath . '/traffic_density.json',
            json_encode($trafficData, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)
        );
        
        $this->command->info('   ✅ Created traffic density data');
    }
    
    private function createMaintenanceTeams($dataPath)
    {
        $teams = [];
        
        File::put(
            $dataPath . '/maintenance_teams.json',
            json_encode($teams, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)
        );
        
        $this->command->info('   ✅ Created maintenance teams');
    }
}
