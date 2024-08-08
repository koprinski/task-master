<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
use Carbon\Carbon;
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
        return view('task.habits', ['habits' => Auth::user()->habits]);
    }
    public function dailyTasks(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        return view('task.daily', ['dailyTasks' => Auth::user()->dailyTasks]);
    }
    public function longTermTasks(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        return view('task.longTerm', ['longTermTasks' => Auth::user()->longTermTasks]);
    }

    public function closeModal(): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        app(UserService::class)->closeModal();
        return redirect('daily');
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
        return response()->json(['success' => true, 'message' => 'Task deleted successfully','points' => Auth::user()->points]);
    }
    public function deleteDaily($id): \Illuminate\Http\JsonResponse
    {
        DailyTask::findOrFail($id)->delete();
        return response()->json(['success' => true, 'message' => 'Task deleted successfully','points' => Auth::user()->points]);
    }
    public function deleteLong($id):\Illuminate\Http\JsonResponse
    {
        return response()->json(['success' => true,
            'message' => 'Task completed successfully',
            'points' => app(UserService::class)->deleteLongTask($id)]);
    }

    //Points functions
    public function PointsHabit($check): \Illuminate\Http\JsonResponse
    {
        return response()->json(['success' => true,
            'message' => 'Points changed successfully',
            'points' => app(UserService::class)->changePointsH($check)]);
    }

    public function completeD($id): \Illuminate\Http\JsonResponse
    {
        $userStats = app(UserService::class)->changePointsD($id);
        return response()->json(['success' => true,
            'message' => 'Task completed successfully',
            'points' => $userStats['points'],
            'count' => $userStats['count']]);
    }

    public function completeL($id): \Illuminate\Http\JsonResponse
    {
        return response()->json(['success' => true,
            'message' => 'Task completed successfully',
            'points' => app(UserService::class)->changePointsL($id)]);
    }

}
