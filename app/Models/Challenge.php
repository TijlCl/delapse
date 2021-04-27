<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Challenge extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
    ];


    /**
     * @return BelongsTo
     */
    public function image()
    {
        return $this->belongsTo(Image::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'challenge_user')
            ->withTimestamps()
            ->withPivot(['image', 'description', 'completed_at', 'invalid_at'])
            ->using(ChallengeUser::class);
    }
}
