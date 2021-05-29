<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    /**
     * @return HasMany
     */
    public function events()
    {
        return $this->hasMany(Event::class);
    }

    /**
     * @return HasMany
     */
    public function achievements()
    {
        return $this->hasMany(Achievement::class);
    }

}
