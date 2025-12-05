<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'two_factor_enabled',
        'two_factor_code',
        'two_factor_expires_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_code',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'two_factor_enabled' => 'boolean',
            'two_factor_expires_at' => 'datetime',
        ];
    }

    /**
     * توليد رمز التحقق من خطوتين
     */
    public function generateTwoFactorCode(): void
    {
        $this->two_factor_code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $this->two_factor_expires_at = now()->addMinutes(10);
        $this->save();
    }

    /**
     * مسح رمز التحقق
     */
    public function clearTwoFactorCode(): void
    {
        $this->two_factor_code = null;
        $this->two_factor_expires_at = null;
        $this->save();
    }

    /**
     * التحقق من صحة الرمز
     */
    public function isValidTwoFactorCode(string $code): bool
    {
        return $this->two_factor_code === $code 
            && $this->two_factor_expires_at 
            && $this->two_factor_expires_at->isFuture();
    }
}
