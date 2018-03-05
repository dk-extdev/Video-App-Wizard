<?php

namespace App\Repositories;

use App\User;
use App\UserVideos;

class UserRepository
{

    public function getTodaysVideoCount(User $user) : int
    {
        return UserVideos::where('user_id', $user->id)
                         ->whereRaw('DATE(created_at) = CURRENT_DATE')
                         ->count();
    }

    public function overDailyLimit(User $user) : bool
    {
        $dailyLimit = $user->is_premium ? User::DAILY_LIMIT_PREMIUM : User::DAILY_LIMIT_STANDARD;

        $dailyCount = $this->getTodaysVideoCount($user);

        return ($dailyCount >= $dailyLimit);
    }

}
