<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\File;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        // التحقق من الأدوار وتوجيه المستخدم للوحة المناسبة
        if ($user->hasRole('super_admin')) {
            return $this->superAdminDashboard();
        }
        
        if ($user->hasRole('admin')) {
            return $this->adminDashboard();
        }
        
        if ($user->hasRole('government')) {
            return $this->governmentDashboard();
        }
        
        if ($user->hasRole('investor')) {
            return $this->investorDashboard();
        }
        
        // Default: user dashboard
        return $this->userDashboard();
    }
    
    protected function superAdminDashboard()
    {
        // إحصائيات شاملة
        $stats = [
            'total_users' => User::count(),
            'total_services' => $this->getServicesCount(),
            'total_projects' => $this->getProjectsCount(),
            'total_incidents' => $this->getIncidentsCount(),
            'government_entities' => User::where('role', 'government')->count(),
            'investors' => User::where('role', 'investor')->count(),
            'active_roads' => 8,
            'maintenance_roads' => 2
        ];
        
        return view('dashboards.super-admin', compact('stats'));
    }
    
    protected function governmentDashboard()
    {
        $stats = [
            'pending_reports' => 15,
            'active_centers' => 8,
            'response_time' => '12 دقيقة',
            'completed_today' => 23
        ];
        
        return view('dashboards.government', compact('stats'));
    }
    
    protected function investorDashboard()
    {
        $stats = [
            'analyzed_areas' => 12,
            'active_projects' => 5,
            'roi_prediction' => '18%',
            'risk_level' => 'متوسط'
        ];
        
        return view('dashboards.investor', compact('stats'));
    }
    
    protected function userDashboard()
    {
        $stats = [
            'nearby_services' => 8,
            'traffic_status' => 'جيد',
            'nearest_hospital' => '2.5 كم',
            'average_wait_time' => '15 دقيقة'
        ];
        
        return view('dashboards.user', compact('stats'));
    }
    
    protected function adminDashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'pending_reports' => 38,
            'completed_reports' => 89,
        ];
        
        return view('dashboards.admin', compact('stats'));
    }
    
    private function getServicesCount()
    {
        $json = File::get(base_path('data/riyadh_emergency_services.json'));
        return count(json_decode($json, true));
    }
    
    private function getProjectsCount()
    {
        $json = File::get(base_path('data/riyadh_municipal_projects.json'));
        return count(json_decode($json, true));
    }
    
    private function getIncidentsCount()
    {
        return rand(10, 50); // مؤقت
    }
}
