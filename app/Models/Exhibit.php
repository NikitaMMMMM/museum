<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exhibit extends Model
{
    /** @use HasFactory<\Database\Factories\ExhibitFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'description',
        'year_created',
        'condition',
        'donor_name',
        'user_id',
        'is_published',
    ];

    protected $hidden = [
        'inventory_number',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'year_created' => 'integer',
    ];

    public function getRouteKeyName() {
        return 'slug';
    }

    public function exhibitMedia(): HasMany {
        return $this->hasMany(ExhibitMedia::class);
    }
}
