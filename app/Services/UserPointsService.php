<?php

namespace App\Services;

use App\Models\DailyTask;
use App\Models\LongTermTask;
use Illuminate\Support\Facades\Auth;

class UserPointsService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function changePointsH(string $check): int
    {
        $user = Auth::user();
        if ($check == '+')
        {
            $user->points += 50;
        }
        if ($check == '-')
        {
            $user->points -= 100;
        }
        $user->save();
        return $user->points;
    }

    public function changePointsD(int $id): array
    {
        $user = Auth::user();
        $user->points += 100;
        $dailyTask = DailyTask::findOrFail($id);
        $dailyTask->update(['completed' => true]);
        $dailyTask->increment('count');
        $user->save();
        return ["points" => $user->points, "count" => $dailyTask['count']];
    }


    public function changePointsL(int $id): int
    {
        $longTask = LongTermTask::findOrFail($id);
        $user = Auth::user();
        if (strtotime($longTask['date']) > time())
        {
            $user->points += 300;
        }
        else
        {
            $user->points += 50;
        }
        $user->save();
        $longTask->delete();
        return $user->points;
    }
}
