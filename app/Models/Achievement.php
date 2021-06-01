<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Achievement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
    ];

    /**
     *
     * @return belongsToMany
     */
    public function user()
    {
        return $this->belongsToMany(User::class, 'achievement_user')
            ->withTimestamps();
    }

    /**
     * @return BelongsTo
     */
    public function image()
    {
        return $this->belongsTo(Image::class);
    }
}
