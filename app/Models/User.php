<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }
    
    public function isUser(): bool {
        return $this->role === 'user';
    }
    
    public function isAdmin(): bool {
        return $this->role === 'admin';
    }
    
    public function isSuperAdmin(): bool {
        return $this->role === 'super_admin';
    }

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'role',
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
protected $casts = [
    'email_verified_at' => 'datetime',
    'password'          => 'hashed',
    'points'            => 'integer',
];

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

public function badges(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
{
    return $this->belongsToMany(Badge::class)->withTimestamps();
}

// app/Models/Badge.php
public function users()
{
    return $this->belongsToMany(User::class)->withTimestamps();
}

public function getPointsAttribute($value)
{
    // Jika $value null, ambil nilai dari key "Points" pada atribut asli
    if ($value === null && isset($this->attributes['Points'])) {
        return $this->attributes['Points'];
    }
    return $value ?? 0;
}
}