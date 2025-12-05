<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EntityController extends Controller
{
    public function index()
    {
        $entities = User::where('role', 'government')->latest()->paginate(15);
        return view('admin.entities.index', compact('entities'));
    }
    
    public function create()
    {
        return view('admin.entities.create');
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:20',
            'organization' => 'required|string|max:255',
            'password' => 'required|string|min:8'
        ]);
        
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'organization' => $validated['organization'],
            'password' => Hash::make($validated['password']),
            'role' => 'government',
            'avatar' => 'https://ui-avatars.com/api/?name=' . urlencode($validated['name']) . '&background=3b82f6&color=fff&size=200'
        ]);
        
        return redirect()->route('admin.entities.index')->with('success', 'تم إضافة الجهة بنجاح');
    }
    
    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'تم حذف الجهة بنجاح');
    }
}
