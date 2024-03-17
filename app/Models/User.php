<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Concerns\UserSlugable;
use App\Models\Scopes\User\UserScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @function userInfo
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, UserSlugable, UserScope;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return void
     */
    protected static function boot(): void
    {
        parent::boot();

        static::bootUserSlugable();
    }

    /**
     * @return HasOne
     */
    public function userInfo(): HasOne
    {
        return $this->hasOne(UserInfo::class);
    }

    /**
     * @return HasOne
     */
    public function userProfileImage(): HasOne
    {
        return $this->hasOne(UserProfileImage::class);
    }

    /**
     * @return HasMany
     */
    public function userPosts(): HasMany
    {
        return $this->hasMany(Post::class);
    }


    /**
     * @return BelongsToMany
     */
    public function userFollowers(): BelongsToMany
    {
        return $this->belongsToMany(self::class, 'user_followers', 'user_id', 'follower_id');
    }

    /**
     * @return BelongsToMany
     */
    public function userFollowing(): BelongsToMany
    {
        return $this->belongsToMany(self::class, 'user_followers', 'follower_id', 'user_id');
    }


    /**
     * @return HasMany
     */
    public function followingRequests(): HasMany
    {
        return $this->hasMany(FollowRequest::class, "sender_id");
    }

    /**
     * @return HasMany
     */
    public function followerRequests(): HasMany
    {
        return $this->hasMany(FollowRequest::class, "reciever_id");
    }
}
