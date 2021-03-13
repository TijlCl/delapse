<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Chat extends Model
{
    use HasFactory;


    /**
     *
     * @return BelongsTo
     */
    public function primaryUser()
    {
        return $this->belongsTo(User::class);
    }

    /**
     *
     * @return BelongsTo
     */
    public function secondaryUser()
    {
        return $this->belongsTo(User::class);
    }

    /**
     *
     * @return HasMany
     *
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
