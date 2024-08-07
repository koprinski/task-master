<?php

namespace App\Services;

use App\Models\DailyTask;
use App\Models\LongTermTask;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserService
{
    private $user;

    private const POINTS_INCREMENT_H = 50;
    private const POINTS_DECREMENT_H = 100;
    private const POINTS_INCREMENT_D = 100;
    private const POINTS_DECREMENT_D = 150;
    private const POINTS_INCREMENT_L_BEFORE = 300;
    private const POINTS_INCREMENT_L_AFTER = 50;
    private const POINTS_DECREMENT_L = 400;
    public function __construct()
    {
        $this->user = Auth::user();
    }
    public function deleteLongTask(int $id): int
    {
        $longTask = LongTermTask::findOrFail($id);

        if (strtotime($longTask['date']) < time()) {
            $this->decrementUserPoints(self::POINTS_DECREMENT_L);
        }

        $this->user->save();
        $longTask->delete();

        return $this->user->points;    }
    public function changePointsH(string $check): int
    {
        switch ($check) {
            case '+':
                $this->incrementUserPoints(self::POINTS_INCREMENT_H);
                break;
            case '-':
                $this->decrementUserPoints(self::POINTS_DECREMENT_H);
                break;
        }
        $this->user->save();
        return $this->user->points;
    }
    public function changePointsD(int $id): array
    {
        $this->incrementUserPoints(self::POINTS_INCREMENT_D);

        $dailyTask = DailyTask::findOrFail($id);
        $dailyTask->update(['completed' => true]);
        $dailyTask->increment('count');

        $this->user->save();
        return ["points" => $this->user->points, "count" => $dailyTask['count']];
    }
    public function changePointsL(int $id): int
    {
        $longTask = LongTermTask::findOrFail($id);

        if (strtotime($longTask['date']) > time()) {
            $this->incrementUserPoints(self::POINTS_INCREMENT_L_BEFORE);
        } else {
            $this->incrementUserPoints(self::POINTS_INCREMENT_L_AFTER);
        }

        $this->user->save();
        $longTask->delete();
        return $this->user->points;
    }
    private function incrementUserPoints(int $points): void
    {
        $this->user->points += $points;
    }
    public function closeModal(): void
    {
        $this->user->checkedModal = true;
        $this->user->save();

        $dailyTasks = DailyTask::all();

        foreach ($dailyTasks as $dailyTask) {
            if ($dailyTask['completed']) {
                $dailyTask->update(['completed' => false]);
            } else {
                $dailyTask->count = 0;
                $dailyTask->save();

                $user_id = $dailyTask['user_id'];
                $user = User::findOrFail($user_id);
                $user->points -= self::POINTS_DECREMENT_D;
                $user->save();
            }
        }
    }
    private function decrementUserPoints(int $points): void
    {
        $this->user->points -= $points;
    }
}
