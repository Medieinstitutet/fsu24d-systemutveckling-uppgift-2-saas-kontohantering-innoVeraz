<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
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

    public function newsletters()
    {
        return $this->hasMany(Newsletter::class);
    }

    public function subscriptions()
    {
        return $this->belongsToMany(
            Newsletter::class,
            'subscriptions',
            'user_id',
            'newsletter_id'
        )->withTimestamps();
    }
}
