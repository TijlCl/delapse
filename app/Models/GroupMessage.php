<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GroupMessage extends Model
{
    use HasFactory;

    protected $table = 'chat_group_messages';

    protected $fillable = [
        'type',
        'body',
        'send_at'
    ];

    /**
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     *
     * @return BelongsTo
     */
    public function chatGroup()
    {
        return $this->belongsTo(ChatGroup::class);
    }
}
