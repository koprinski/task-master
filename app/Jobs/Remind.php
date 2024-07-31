<?php

namespace App\Jobs;

use App\Mail\Reminder;
use App\Models\DailyTask;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class Remind implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
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
            foreach ($dailytasks as $dailytask)
            {
                if (!$dailytask['completed'])
                {
                   Mail::to($user->email)->send(new Reminder($user));
                }
            }
        }
    }
}
