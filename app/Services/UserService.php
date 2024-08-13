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
    public function __construct($id)
    {
        $this->user = User::FindOrFail($id);
    }
    public function deleteLongTask(int $id): int
    {
        $longTask = LongTermTask::findOrFail($id);

        if (strtotime($longTask['date']) < time()) {
            $this->decrementUserPoints(self::POINTS_DECREMENT_L);
        }

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
        return $this->user->points;
    }
    public function changePointsD(int $id): array
    {
        $this->incrementUserPoints(self::POINTS_INCREMENT_D);

        $dailyTask = DailyTask::findOrFail($id);
        $dailyTask->update(['completed' => true]);
        $dailyTask->increment('count');

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

        $longTask->delete();
        return $this->user->points;
    }
    public function closeModal(): void
    {
        $this->user->update(['checkedModal' => true]);
        $dailyTasks = $this->user->dailyTasks;
        foreach ($dailyTasks as $dailyTask)
        {
        $this->checkDailyTaskCompletion($dailyTask);
        }
    }

    public function checkDailyTaskCompletion(DailyTask $dailyTask): void
    {
        if ($dailyTask['completed']) {
            $dailyTask->update(['completed' => false]);
        } else {
            $dailyTask->update(['count' => 0]);
            $this->decrementUserPoints(self::POINTS_DECREMENT_D);
        }
    }

    private function incrementUserPoints(int $points): void
    {
        $this->user->points += $points;
        $this->user->save();
    }
    private function decrementUserPoints(int $points): void
    {
        $this->user->points -= $points;
        $this->user->save();
    }
}
