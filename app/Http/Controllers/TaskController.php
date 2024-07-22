<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Habit;
use App\Models\DailyTask;
use App\Models\LongTermTask;



class TaskController extends Controller
{
    public function habits(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        $habits = Habit::all();
        return view('task.habits', ['habits' => $habits]);
    }
    public function dailyTasks(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        $dailyTasks = DailyTask::all();
        return view('task.daily', ['dailyTasks' => $dailyTasks]);
    }
    public function longTermTasks(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        $longTermTasks = LongTermTask::all();
        return view('task.longTerm', ['longTermTasks' => $longTermTasks]);
    }
    public function deleteTask($task): \Illuminate\Http\RedirectResponse
    {
        $task::delete();
        return to_route('longTerm');
    }

}
