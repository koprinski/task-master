<?php

namespace App\Jobs;

use App\Models\DailyTask;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

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
        $dailyTasks = DailyTask::all();
        foreach ($dailyTasks as $dailyTask)
        {
            if ($dailyTask['completed'])
            {
                $dailyTask->update(['completed' => false]);
                $dailyTask->save();
            }
            else
            {
               $user_id = $dailyTask['user_id'];
               $user = User::findOrFail($user_id);
               $user->points -= 150;
               $user->save();
            }
        }
    }

}
