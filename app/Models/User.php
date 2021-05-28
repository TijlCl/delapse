<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
        'phone_number',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * This relation can not be eager loaded. Look into composite clusters to resolve the issue if necessary.
     * @return HasMany
     */
    public function chats()
    {
        return $this->hasMany(Chat::class, 'primary_user_id')
            ->orWhere('secondary_user_id', '=', $this->id);
    }

    /**
     * @return HasMany
     */
    public function chatGroups()
    {
        return $this->hasMany(ChatGroup::class);
    }

    /**
     * @return HasMany
     */
    public function friends()
    {
        return $this->hasMany(Friend::class);
    }

    /**
     * @return HasMany
     */
    public function events()
    {
        return $this->hasMany(Event::class);
    }

    /**
     * @return belongsToMany
     */
    public function challenges()
    {
        return $this->belongsToMany(Challenge::class, 'challenge_user')
            ->withTimestamps()
            ->withPivot(['image', 'description', 'completed_at', 'invalid_at'])
            ->using(ChallengeUser::class);
    }

    /**
     * @return belongsToMany
     */
    public function achievements()
    {
        return $this->belongsToMany(Achievement::class, 'achievement_user')
            ->withTimestamps();
    }

    /**
     * @return HasOne
     */
    public function setting()
    {
        return $this->hasOne(Setting::class);
    }

    /**
     * @return hasMany
     */
    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    /**
     * @return hasMany
     */
    public function reportsSend()
    {
        return $this->hasMany(Report::class,'reporter_id', 'user_id');
    }

    /**
     * @return HasOne
     */
    public function soberCounter()
    {
        return $this->hasOne(SoberCounter::class);
    }

    /**
     * @return bool
     */
    public function getIsFriendAttribute()
    {
        return $this->friends()->where('friend_id', 3)->exists();
    }
}
