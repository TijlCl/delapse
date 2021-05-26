<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'reason',
        'description'
    ];

    public static array $availableReasons = ['Inappropriate name', 'Harassment', 'Offencive language', 'Spam', 'Other'];

    /**
     * @return belongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return belongsTo
     */
    public function reporter()
    {
        return $this->belongsTo(User::class,'reporter_id', 'id');
    }
}
