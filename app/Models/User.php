<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class User extends Authenticatable implements HasMedia
{
    use HasFactory, Notifiable, InteractsWithMedia;

    protected $fillable = [
        'name',
        'email',
        'description',
        'username',
        'password',
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

    protected function name(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => strip_tags($value),
        );
    }

    protected function description(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => strip_tags($value),
        );
    }

    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->map(fn (string $name) => Str::of($name)->substr(0, 1))
            ->implode('');
    }

    public function links(): HasMany
    {
        return $this->hasMany(Link::class)->orderBy('order');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatar')
            ->useDisk('avatar')
            ->singleFile();
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('small')
            ->width(200)
            ->format('webp');

        $this->addMediaConversion('medium')
            ->width(400)
            ->format('webp');

        $this->addMediaConversion('large')
            ->width(600)
            ->format('webp');
    }
}
