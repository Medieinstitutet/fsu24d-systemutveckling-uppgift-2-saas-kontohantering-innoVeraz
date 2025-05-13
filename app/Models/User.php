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
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * De nyhetsbrev som denna kund äger.
     */
    public function newsletters()
    {
        return $this->hasMany(Newsletter::class);
    }

    /**
     * De nyhetsbrev som denna användare prenumererar på.
     */
    public function subscriptions()
    {
        return $this->belongsToMany(
            Newsletter::class,
            'subscriptions',   // pivot-tabellen
            'user_id',         // FK i pivot mot denna user
            'newsletter_id'    // FK i pivot mot nyhetsbrevet
        )->withTimestamps();
    }
}
