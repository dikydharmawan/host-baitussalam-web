<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\UserRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'role',
        'position',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            // 'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role' => UserRole::class,
        ];
    }

    public function gallery()
    {
        return $this->hasMany(GalleryImage::class)->orderBy('id');
    }


    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    /**
     * Generic role checker
     */
    public function hasAnyRole(array $roles): bool
    {
        return in_array($this->role, $roles, true);
    }

    /**
     * Helper shortcuts
     */
    public function canManagePenjadwalan(): bool
    {
        return $this->hasAnyRole([
            UserRole::SUPER_ADMIN,
            UserRole::TAKMIR_ADMIN,
            UserRole::TAKMIR,
        ]);
    }

    public function canManageKegiatan(): bool
    {
        return $this->hasAnyRole([
            UserRole::SUPER_ADMIN,
            UserRole::TAKMIR_ADMIN,
            UserRole::TAKMIR,
        ]);
    }

    public function canManageGallery(): bool
    {
        return $this->hasAnyRole([
            UserRole::SUPER_ADMIN,
            UserRole::TAKMIR_ADMIN,
            UserRole::TAKMIR,
        ]);
    }
    public function canManageDokumen(): bool
    {
        return $this->hasAnyRole([
            UserRole::SUPER_ADMIN,
            UserRole::TAKMIR_ADMIN,
            UserRole::TAKMIR,
        ]);
    }
}
