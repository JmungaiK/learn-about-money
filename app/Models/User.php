<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // Add role to fillable attributes
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
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
        'password' => 'hashed',
    ];

    /**
     * Check if the user has the specified role.
     *
     * @param int $role
     * @return bool
     */
    public function role($role)
    {
        // Having a 'role' column in your users table
        return $this->role === $role;
    }

    /**
     * Define a one-to-many relationship with the Rating model.
     */
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    /**
     * Define a one-to-many relationship with the Comment model.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Define the relationship with the Progress model
    public function progress()
    {
        return $this->hasMany(Progress::class);
    }
}
