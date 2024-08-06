<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserPointsService;
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

    public function closeModal(): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        $user = Auth::user();
        $dailyTasks = DailyTask::all();
        $user->checkedModal = true;
        $user->save();
        foreach ($dailyTasks as $dailyTask)
        {
            if ($dailyTask['completed'])
            {
                $dailyTask->update(['completed' => false]);
                $dailyTask->save();
            }
            else
            {
                $dailyTask->count = 0;
                $dailyTask->save();
                $user_id = $dailyTask['user_id'];
                $user = User::findOrFail($user_id);
                $user->points -= 150;
                $user->save();
            }
        }
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
        $user = Auth::user();
        Habit::findOrFail($id)->delete();
        return response()->json(['success' => true, 'message' => 'Task deleted successfully','points' => $user->points]);
    }
    public function deleteDaily($id): \Illuminate\Http\JsonResponse
    {
        $user = Auth::user();
        DailyTask::findOrFail($id)->delete();
        return response()->json(['success' => true, 'message' => 'Task deleted successfully','points' => $user->points]);
    }
    public function deleteLong($id):\Illuminate\Http\JsonResponse
    {
        $longTask = LongTermTask::findOrFail($id);
        $user = Auth::user();
        if (strtotime($longTask['date']) < time())
        {
            $user->points -= 400;
        }
        $user->save();
        $longTask->delete();
        return response()->json(['success' => true, 'message' => 'Task completed successfully', 'points' => $user->points]);
    }

    //Points functions
    public function PointsHabit($check): \Illuminate\Http\JsonResponse
    {
        return response()->json(['success' => true,
            'message' => 'Points changed successfully',
            'points' => app(UserPointsService::class)->changePointsH($check)]);
    }

    public function completeD($id): \Illuminate\Http\JsonResponse
    {
        $userStats = app(UserPointsService::class)->changePointsD($id);
        return response()->json(['success' => true,
            'message' => 'Task completed successfully',
            'points' => $userStats['points'],
            'count' => $userStats['count']]);
    }

    public function completeL($id): \Illuminate\Http\JsonResponse
    {
        return response()->json(['success' => true,
            'message' => 'Task completed successfully',
            'points' => app(UserPointsService::class)->changePointsL($id)]);
    }

}
