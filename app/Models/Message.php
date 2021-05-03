<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'body',
        'send_at'
    ];

    /**
     *
     * @return BelongsTo
     */
    public function from()
    {
        return $this->belongsTo(User::class);
    }

    /**
     *
     * @return BelongsTo
     */
    public function to()
    {
        return $this->belongsTo(User::class);
    }

    /**
     *
     * @return BelongsTo
     */
    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }

    public function getIsUnreadAttribute()
    {
        return is_null($this->seen_at);
    }
}
