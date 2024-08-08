<?php

namespace App\Jobs;

use App\Models\DailyTask;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class UpdateDailyTasks implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $users = User::all();
        foreach ($users as $user)
        {
            $currentUserTime = now()->setTimezone($user->timezone);
            if ($currentUserTime->format('H:i') > '23:59' && $currentUserTime->format('H:i') < '01:00')
            {
                $dailytasks = $user->dailytasks;
                if ($user->checkedModal && $this->checkForUncompletedTasks($dailytasks))
                {
                    $user->checkedModal = false;
                    $user->save();
                }
                else
                {
                    $user->points = $user->points - 150*$this->countUncompletedTasks($dailytasks);
                    $user->save();
                    $this->undoComplete($dailytasks);
                }
            }


        }

    }

    public function undoComplete($dailytasks): void
    {
        foreach ($dailytasks as $dailytask)
        {
            $dailytask->update(['completed' => false]);
            $dailytask->update(['count' => 0]);
        }
    }
    public function checkForUncompletedTasks($dailytasks): bool
    {
        $uncompleted = false;
        foreach ($dailytasks as $dailytask)
        {
            if (!$dailytask['completed'])
            {
                $uncompleted = true;
                break;
            }
        }
        return $uncompleted;
    }

    public function countUncompletedTasks($dailytasks): int
    {
        $count = 0;
        foreach ($dailytasks as $dailytask)
        {
            if (!$dailytask['completed'])
            {
               $count++;
            }
        }
        return $count;
    }


}
