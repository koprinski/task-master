<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Habit;
use App\Models\DailyTask;
use App\Models\LongTermTask;
use Illuminate\Support\Facades\Auth;


class TaskController extends Controller
{
    //Task views
    public function habits(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        $habits = Auth::user()->habits;
        return view('task.habits', ['habits' => $habits]);
    }
    public function dailyTasks(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        $dailyTasks = Auth::user()->dailyTasks;
        return view('task.daily', ['dailyTasks' => $dailyTasks]);
    }
    public function longTermTasks(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        $longTermTasks = Auth::user()->longTermTasks;
        return view('task.longTerm', ['longTermTasks' => $longTermTasks]);
    }
    // Insert views
    public function iHabits(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        return view('insert.habits');
    }
    public function iDaily(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        return view('insert.daily');
    }
    public function iLongTerm(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        return view('insert.longTerm');
    }

    //Create row functions
    public function newHabit()
    {
        request()->validate(['name' => ['required']]);

        Habit::create(['name' => request('name'), 'user_id' => auth()->id()]);

        return redirect('habits');
    }
    public function newDaily()
    {
        request()->validate(['name' => ['required']]);

        DailyTask::create(['name' => request('name'), 'user_id' => auth()->id()]);

        return redirect('daily');
    }
    public function newLongTerm()
    {
        request()->validate(['name' => ['required'], 'date' => ['required', 'after:today']]);

        LongTermTask::create(['name' => request('name'), 'date' => request('date'), 'user_id' => auth()->id()]);

        return redirect('longTerm');
    }

    //Delete row functions
    public function deleteHabit($id): \Illuminate\Http\RedirectResponse
    {
        Habit::findOrFail($id)->delete();
        return to_route('habits');
    }
    public function deleteDaily($id): \Illuminate\Http\RedirectResponse
    {
        DailyTask::findOrFail($id)->delete();
        return to_route('daily');
    }
    public function deleteLong($id): \Illuminate\Http\RedirectResponse
    {
        LongTermTask::findOrFail($id)->delete();
        return to_route('longTerm');
    }


}
