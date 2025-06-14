<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Newsletter extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subscribers()
    {
        return $this->belongsToMany(
            User::class,
            'subscriptions',
            'newsletter_id',
            'user_id'
        )->withTimestamps();
    }
}
