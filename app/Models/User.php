<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable, HasApiTokens;

    public function canAccessPanel(\Filament\Panel $panel): bool
    {
        return str_ends_with($this->email, 'poultrymasterbd.com') && $this->hasVerifiedEmail();
    }

    protected $guarded = [
        'isAdmin'
    ];
    protected $fillable = [
        'name',
        'email',
        'phone',
        'country_code',
        'password',
        "email_verified_at",
        "role",
        "address",
        "otp",
        "status",
        "last_login",
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
