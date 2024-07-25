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
    public function deleteHabit($id): \Illuminate\Http\JsonResponse
    {
        Habit::findOrFail($id)->delete();
        return response()->json(['success' => true, 'message' => 'Task deleted successfully']);
    }
    public function deleteDaily($id): \Illuminate\Http\JsonResponse
    {
        DailyTask::findOrFail($id)->delete();
        return response()->json(['success' => true, 'message' => 'Task deleted successfully']);
    }
    public function deleteLong($id):\Illuminate\Http\JsonResponse
    {
        LongTermTask::findOrFail($id)->delete();
        return response()->json(['success' => true, 'message' => 'Task deleted successfully']);
    }

    //Points functions
    public function PointsHabit($check): \Illuminate\Http\JsonResponse
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
        return response()->json(['success' => true, 'message' => 'Points changed successfully', 'points' => $user->points]);
    }

    public function completeD($id): \Illuminate\Http\JsonResponse
    {

        $user = Auth::user();
        $user->points += 100;
        DailyTask::findOrFail($id)->update(['completed' => true]);
        $user->save();
        DailyTask::findOrFail($id)->save();
        return response()->json(['success' => true, 'message' => 'Task completed successfully', 'points' => $user->points]);
    }

}
