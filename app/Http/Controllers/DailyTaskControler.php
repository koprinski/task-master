<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Daily_tasks;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DailyTaskControler extends Controller
{
public function serch()
{

    $arr = Daily_tasks::all();
    $id = Auth::user()->id;;

    for ($i = 0; $i < count($arr); $i++) {
        $temp = $arr[$i];
        if ($id == $temp->id) {
            echo "task " . $temp->daily_task;
            break;
        }
    }

    return view('welcome');
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
