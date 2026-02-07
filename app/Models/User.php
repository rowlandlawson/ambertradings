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
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'balance',
        'total_invested',
        'total_profit',
        'phone',
        'country',
        'avatar',
        'is_active',
        'verification_code',
        'verification_expires_at',
        'reset_code',
        'reset_expires_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'verification_code',
        'reset_code',
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
            'balance' => 'decimal:2',
            'total_invested' => 'decimal:2',
            'total_profit' => 'decimal:2',
            'is_active' => 'boolean',
            'verification_expires_at' => 'datetime',
            'reset_expires_at' => 'datetime',
        ];
    }

    /**
     * Check if the user is an admin.
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Get the user's investments.
     */
    public function investments()
    {
        return $this->hasMany(Investment::class);
    }

    /**
     * Get the user's transactions.
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
