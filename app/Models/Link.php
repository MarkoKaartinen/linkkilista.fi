<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Link extends Model implements Sortable
{
    use SortableTrait;

    protected $fillable = [
        'name',
        'url',
        'user_id',
        'order',
        'description',
    ];

    protected function name(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => strip_tags($value),
        );
    }

    protected function url(): Attribute
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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
