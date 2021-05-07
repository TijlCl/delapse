<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ChatGroup extends Model
{
    use HasFactory;

    /**
     *
     * @return BelongsToMany
     *
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'chat_group_user');
    }

    /**
     *
     * @return HasMany
     *
     */
    public function messages()
    {
        return $this->hasMany(GroupMessage::class)->orderByDesc('send_at');
    }
}
