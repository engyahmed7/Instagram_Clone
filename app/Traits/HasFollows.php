<?php
namespace App\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasFollows
{
    public function follow(User $user)
    {
        return $this->follows()->save($user);
    }

    public function unfollow(User $user)
    {
        return $this->follows()->detach($user);
    }

    public function follows(): BelongsToMany
    {
        return $this->belongsToMany(User::class , 'follows', 'user_id', 'following_user_id')->withTimestamps();
    }

    public function followers(): BelongsToMany
    {
        return $this->belongsToMany(User::class , 'follows', 'following_user_id', 'user_id')->withTimestamps();
    }

    public function toggleFollow(User $user)
    {
        if ($this->isFollowing($user)) {
            return $this->unfollow($user);
        }
        return $this->follow($user);
    }
    public function isFollowing(User $user)
    {
        return $this->follows()->where('following_user_id', $user->id())->exists();
    }
    public function followersList(){
        return $this->followers->map(function ($user) {
            
            return $user;
            

        });
    }

    public function followingList(){

        return $this->follows->map(function ($user) {

            return $user;

        });
    }
}
