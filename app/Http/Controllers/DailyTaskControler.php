<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Daily_tasks;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DailyTaskControler extends Controller
{
    public function serch() {
        $arr = Daily_tasks::all();
        $id = Auth::user()->id;
        $array = [];

        foreach ($arr as $task) {
            if ($id == $task->id) {
                $array[] = $task->daily_task;
            }
        }

        $aaa = json_encode($array);
        return view('Daily_tasks', compact('aaa'));
    }
    public function store(Request $request)
    {
        $id = Auth::user()->id;;
        $product = [
            'id' => $id,
            'daily_task' => $request->task_name,
        ];
        Daily_tasks::insert($product);
        if (Daily_tasks::all()->count() != 0) {
            echo "saved";
        }

        return view('Daily_tasks',[$DailyTasks = daily_tasks::all()]);
    }
}
