<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class MapDataController extends Controller
{
    /**
     * Get all emergency services in Riyadh
     */
    public function getEmergencyServices(): JsonResponse
    {
        try {
            $jsonPath = base_path('data/riyadh_emergency_services.json');
            
            if (!File::exists($jsonPath)) {
                return response()->json([
                    'error' => 'ملف بيانات خدمات الطوارئ غير موجود',
                    'path' => $jsonPath
                ], 404);
            }
            
            $json = File::get($jsonPath);
            $services = json_decode($json, true);
            
            // إضافة حقول إضافية
            $services = array_map(function($service) {
                return array_merge($service, [
                    'distance' => $this->calculateDistance($service['lat'], $service['lng']),
                    'eta' => $this->calculateETA($service['lat'], $service['lng'])
                ]);
            }, $services);
            
            return response()->json($services);
            
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'خطأ في تحميل بيانات خدمات الطوارئ',
                'message' => $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Get all municipal projects in Riyadh
     */
    public function getMunicipalProjects(): JsonResponse
    {
        try {
            $jsonPath = base_path('data/riyadh_municipal_projects.json');
            
            if (!File::exists($jsonPath)) {
                return response()->json([
                    'error' => 'ملف بيانات المشاريع البلدية غير موجود'
                ], 404);
            }
            
            $json = File::get($jsonPath);
            $projects = json_decode($json, true);
            
            return response()->json($projects);
            
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'خطأ في تحميل المشاريع البلدية',
                'message' => $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Get all roads information in Riyadh
     */
    public function getRoads(): JsonResponse
    {
        try {
            $jsonPath = base_path('data/riyadh_roads.json');
            
            if (!File::exists($jsonPath)) {
                return response()->json([
                    'error' => 'ملف بيانات الطرق غير موجود'
                ], 404);
            }
            
            $json = File::get($jsonPath);
            $roads = json_decode($json, true);
            
            return response()->json($roads);
            
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'خطأ في تحميل بيانات الطرق',
                'message' => $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Get all roads with traffic data
     */
    public function getRoadsDetailed(): JsonResponse
    {
        return Cache::remember('roads_detailed', 600, function() {
            $speedData = $this->loadJsonFile('average_speed_on_roads.json');
            $densityData = $this->loadJsonFile('traffic_density_on_roads.json');
            $flowData = $this->loadJsonFile('traffic_flow_data.json');
            
            // دمج البيانات
            $mergedData = [];
            foreach ($speedData as $speed) {
                $roadName = $speed['road_name'];
                
                $mergedData[] = [
                    'name' => $roadName,
                    'average_speed' => $speed['average_speed'],
                    'peak_speed' => $speed['peak_hour_speed'],
                    'off_peak_speed' => $speed['off_peak_speed'],
                    'status' => $speed['status'],
                    'lat' => $speed['lat'],
                    'lng' => $speed['lng'],
                    'density' => $this->findDensityForRoad($roadName, $densityData),
                    'flow' => $this->findFlowForRoad($roadName, $flowData),
                    'incidents' => rand(0, 3),
                    'description' => $this->generateDescription($speed)
                ];
            }
            
            return response()->json($mergedData);
        });
    }
    
    /**
     * Get maintenance data
     */
    public function getMaintenanceData(): JsonResponse
    {
        return Cache::remember('maintenance_data', 3600, function() {
            $teams = $this->loadJsonFile('distribution_of_road_maintenance_teams.json');
            $equipment = $this->loadJsonFile('road_maintenance_equipment_by_ministry_branches.json');
            
            return response()->json([
                'teams' => $teams,
                'equipment' => $equipment,
                'summary' => [
                    'total_teams' => count($teams),
                    'total_equipment' => array_sum(array_column($equipment, 'quantity')),
                    'regions_covered' => count(array_unique(array_column($teams, 'region')))
                ]
            ]);
        });
    }
    
    /**
     * Search all services and projects
     */
    public function search(Request $request): JsonResponse
    {
        $query = $request->input('q', '');
        
        if (strlen($query) < 2) {
            return response()->json([
                'results' => [],
                'message' => 'يجب إدخال حرفين على الأقل للبحث'
            ]);
        }
        
        $cacheKey = 'search_' . md5($query);
        
        return Cache::remember($cacheKey, 300, function() use ($query) {
            $emergencyServices = $this->getCachedEmergencyServices();
            $municipalProjects = $this->getCachedMunicipalProjects();
            
            $results = [];
            
            // البحث في خدمات الطوارئ
            foreach ($emergencyServices as $service) {
                if (stripos($service['name'], $query) !== false || 
                    stripos($service['address'], $query) !== false) {
                    $results[] = [
                        'id' => $service['id'],
                        'name' => $service['name'],
                        'type' => 'service',
                        'category' => $service['type'],
                        'address' => $service['address'],
                        'lat' => $service['lat'],
                        'lng' => $service['lng'],
                        'icon' => $this->getServiceIcon($service['type']),
                        'distance' => $service['distance'] ?? null
                    ];
                }
            }
            
            // البحث في المشاريع البلدية
            foreach ($municipalProjects as $project) {
                if (stripos($project['name'], $query) !== false || 
                    stripos($project['location'], $query) !== false) {
                    $results[] = [
                        'id' => $project['id'],
                        'name' => $project['name'],
                        'type' => 'project',
                        'category' => $project['type'],
                        'address' => $project['location'],
                        'lat' => $project['lat'],
                        'lng' => $project['lng'],
                        'icon' => $this->getProjectIcon($project['type']),
                        'status' => $project['status']
                    ];
                }
            }
            
            return response()->json([
                'results' => array_slice($results, 0, 10),
                'total' => count($results),
                'query' => $query
            ]);
        });
    }
    
    /**
     * Get cached emergency services
     */
    private function getCachedEmergencyServices()
    {
        return Cache::remember('emergency_services', 3600, function() {
            $jsonPath = base_path('data/riyadh_emergency_services.json');
            if (!File::exists($jsonPath)) return [];
            return json_decode(File::get($jsonPath), true);
        });
    }
    
    /**
     * Get cached municipal projects
     */
    private function getCachedMunicipalProjects()
    {
        return Cache::remember('municipal_projects', 3600, function() {
            $jsonPath = base_path('data/riyadh_municipal_projects.json');
            if (!File::exists($jsonPath)) return [];
            return json_decode(File::get($jsonPath), true);
        });
    }
    
    /**
     * Get statistics
     */
    public function getStatistics()
    {
        return Cache::remember('map_statistics', 600, function() {
            $emergencyServices = $this->getCachedEmergencyServices();
            $municipalProjects = $this->getCachedMunicipalProjects();
            $roads = Cache::remember('roads', 3600, function() {
                $jsonPath = base_path('data/riyadh_roads.json');
                if (!File::exists($jsonPath)) return [];
                return json_decode(File::get($jsonPath), true);
            });
            
            return response()->json([
                'total_services' => count($emergencyServices),
                'total_projects' => count($municipalProjects),
                'total_roads' => count($roads),
                'services_by_type' => $this->countByType($emergencyServices, 'type'),
                'projects_by_status' => $this->countByType($municipalProjects, 'status'),
                'roads_by_status' => $this->countByType($roads, 'status')
            ]);
        });
    }
    
    private function countByType($items, $field)
    {
        $counts = [];
        foreach ($items as $item) {
            $type = $item[$field] ?? 'unknown';
            $counts[$type] = ($counts[$type] ?? 0) + 1;
        }
        return $counts;
    }
    
    private function getServiceIcon($type)
    {
        $icons = [
            'hospital' => '🏥',
            'ambulance' => '🚑',
            'fire_station' => '🚒',
            'police' => '👮',
            'clinic' => '🏥'
        ];
        return $icons[$type] ?? '🏥';
    }
    
    private function getProjectIcon($type)
    {
        $icons = [
            'road' => '🛣️',
            'park' => '🌳',
            'lighting' => '💡',
            'building' => '🏗️'
        ];
        return $icons[$type] ?? '🏗️';
    }
    
    /**
     * Calculate distance from user location (mock - should use actual user location)
     */
    private function calculateDistance($lat, $lng)
    {
        // Default user location (Riyadh center)
        $userLat = 24.7136;
        $userLng = 46.6753;
        
        $distance = $this->haversineDistance($userLat, $userLng, $lat, $lng);
        
        return number_format($distance, 1) . ' كم';
    }
    
    /**
     * Calculate ETA (Estimated Time of Arrival)
     */
    private function calculateETA($lat, $lng)
    {
        $userLat = 24.7136;
        $userLng = 46.6753;
        
        $distance = $this->haversineDistance($userLat, $userLng, $lat, $lng);
        $avgSpeed = 40;
        $timeInMinutes = round(($distance / $avgSpeed) * 60);
        
        return $timeInMinutes . ' دقيقة';
    }
    
    /**
     * Calculate distance between two coordinates using Haversine formula
     */
    private function haversineDistance($lat1, $lng1, $lat2, $lng2)
    {
        $earthRadius = 6371; // Earth radius in kilometers
        
        $latDiff = deg2rad($lat2 - $lat1);
        $lngDiff = deg2rad($lng2 - $lng1);
        
        $a = sin($latDiff / 2) * sin($latDiff / 2) +
             cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
             sin($lngDiff / 2) * sin($lngDiff / 2);
        
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        
        return $earthRadius * $c;
    }
    
    /**
     * Clear all cache
     */
    public function clearCache()
    {
        Cache::forget('emergency_services');
        Cache::forget('municipal_projects');
        Cache::forget('roads');
        Cache::forget('map_statistics');
        
        return response()->json([
            'success' => true,
            'message' => 'تم مسح الذاكرة المؤقتة بنجاح'
        ]);
    }
    
    /**
     * Get live updates (simulated)
     */
    public function getLiveUpdates()
    {
        $updates = [
            'timestamp' => now()->toIso8601String(),
            'road_updates' => $this->getSimulatedRoadUpdates(),
            'service_updates' => $this->getSimulatedServiceUpdates(),
            'alerts' => $this->getSimulatedAlerts()
        ];
        
        return response()->json($updates);
    }
    
    private function getSimulatedRoadUpdates()
    {
        $roads = ['طريق الملك فهد', 'طريق الملك عبدالله', 'شارع العليا', 'طريق الملك خالد'];
        $statuses = ['clear', 'moderate', 'congested'];
        
        return [
            'road' => $roads[array_rand($roads)],
            'status' => $statuses[array_rand($statuses)],
            'speed' => rand(15, 80),
            'incidents' => rand(0, 3)
        ];
    }
    
    private function getSimulatedServiceUpdates()
    {
        return [
            'updated_count' => rand(1, 5),
            'message' => 'تم تحديث حالة بعض الخدمات'
        ];
    }
    
    private function getSimulatedAlerts()
    {
        $alerts = [
            ['icon' => '🚧', 'message' => 'صيانة طارئة على طريق الملك فهد', 'priority' => 'high'],
            ['icon' => '⚠️', 'message' => 'حادث بسيط على شارع العليا', 'priority' => 'medium'],
            ['icon' => '🏫', 'message' => 'منطقة مدرسية - خفض السرعة', 'priority' => 'low']
        ];
        
        return rand(0, 1) ? [$alerts[array_rand($alerts)]] : [];
    }
    
    private function loadJsonFile($filename)
    {
        $path = base_path("data/{$filename}");
        if (!File::exists($path)) return [];
        
        return json_decode(File::get($path), true) ?? [];
    }
    
    private function findDensityForRoad($roadName, $densityData)
    {
        foreach ($densityData as $density) {
            if (stripos($density['road_name'], $roadName) !== false) {
                return $density;
            }
        }
        return null;
    }
    
    private function findFlowForRoad($roadName, $flowData)
    {
        $flows = [];
        foreach ($flowData as $flow) {
            if (stripos($flow['location'], $roadName) !== false) {
                $flows[] = $flow;
            }
        }
        return $flows;
    }
    
    private function generateDescription($speed)
    {
        $status = $speed['status'];
        $descriptions = [
            'clear' => 'الطريق سالك بدون ازدحام - سرعة ممتازة',
            'moderate' => 'حركة متوسطة مع بعض التباطؤ',
            'congested' => 'ازدحام شديد - يفضل اختيار طريق بديل',
            'maintenance' => 'يوجد أعمال صيانة على الطريق'
        ];
        
        return $descriptions[$status] ?? 'لا توجد معلومات';
    }
}
