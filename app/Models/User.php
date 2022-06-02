<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use App\QueryBuilders\UserBuilder;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function incomingConnections(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'connection',
            'requested_to_user_id',
            'requested_by_user_id',
        )
            ->whereNull('connected_at')
            ->withTimestamps()
            ->using(Connection::class);
    }

    public function outgoingConnections(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'connection',
            'requested_by_user_id',
            'requested_to_user_id',
        )
            ->whereNull('connected_at')
            ->withTimestamps()
            ->using(Connection::class);
    }

    public function newEloquentBuilder($query): UserBuilder
    {
        return new UserBuilder($query);
    }
}
