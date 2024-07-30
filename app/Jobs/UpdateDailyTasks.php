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
            $dailytasks = $user->dailytasks;
            $uncompleted = 0;
            foreach ($dailytasks as $dailytask)
            {
               if (!$dailytask['completed'])
               {
                   $uncompleted++;
               }
            }
            if ($user->checkedModal && $uncompleted > 0)
            {
                $user->checkedModal = false;
                $user->save();
            }
            else
            {
                foreach ($dailytasks as $dailytask)
                {
                    $dailytask->update(['completed' => false]);
                    $dailytask->count = 0;
                    $dailytask->save();
                }
                $user->points = $user->points - 150*$uncompleted;
                $user->save();
            }
        }

    }

}
