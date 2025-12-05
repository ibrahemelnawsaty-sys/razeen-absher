<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile.edit');
    }
    
    public function update(Request $request)
    {
        $user = auth()->user();
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'organization' => 'nullable|string|max:255',
            'avatar' => 'nullable|image|max:2048'
        ]);
        
        if ($request->hasFile('avatar')) {
            // حذف الصورة القديمة
            if ($user->avatar && !str_contains($user->avatar, 'ui-avatars.com')) {
                Storage::delete($user->avatar);
            }
            
            // رفع الصورة الجديدة
            $path = $request->file('avatar')->store('avatars', 'public');
            $validated['avatar'] = '/storage/' . $path;
        }
        
        $user->update($validated);
        
        return redirect()->route('profile.edit')->with('success', 'تم تحديث الملف الشخصي بنجاح');
    }
    
    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed'
        ]);
        
        if (!Hash::check($request->current_password, auth()->user()->password)) {
            return back()->withErrors(['current_password' => 'كلمة المرور الحالية غير صحيحة']);
        }
        
        auth()->user()->update([
            'password' => Hash::make($request->password)
        ]);
        
        return redirect()->route('profile.edit')->with('success', 'تم تحديث كلمة المرور بنجاح');
    }
}
