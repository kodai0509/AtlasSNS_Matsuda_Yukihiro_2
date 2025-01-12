<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'username',
        'email',
        'password',
        'icon_image',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getIconUrlAttribute()
    {
        return $this->icon_image ? asset('storage/icons/' . $this->icon_image) : asset('images/default-icon.png');
    }

    // フォローしているユーザー情報
    public function following()
    {
        return $this->belongsToMany(User::class, 'follows', 'following_id', 'followed_id');
    }

    // フォロワー情報
    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'followed_id', 'following_id');
    }

    // フォローする
    public function follow(int $user_id)
    {
        if (!$this->isFollowing($user_id)) {
            $this->following()->attach($user_id);
        }
    }

    // フォロー解除
    public function unfollow(int $user_id)
    {
        if ($this->isFollowing($user_id)) {
            $this->following()->detach($user_id);
        }
    }

    // フォローしているか確認
    public function isFollowing(int $user_id)
    {
        return $this->following()->where('followed_id', $user_id)->exists();
    }

    // フォローされているか確認
    public function isFollowed(int $user_id)
    {
        return $this->followers()->where('following_id', $user_id)->exists();
    }
}
