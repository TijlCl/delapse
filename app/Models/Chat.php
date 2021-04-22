<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
        return $this->hasMany(Message::class)->orderByDesc('send_at');
    }

    /**
     *
     * @return hasOne
     *
     */
    public function lastMessage()
    {
        return $this->hasOne(Message::class)->latest('send_at')->limit(1);
    }
}
