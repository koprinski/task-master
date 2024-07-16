<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Daily_tasks;
use Illuminate\Support\Facades\DB;

class DailyTaskControler extends Controller
{
public function Serch(Request $request)
{
    $username = request('username');
    $arr = Daily_tasks::all();

    for ($i = 0; $i < count($arr); $i++) {
        $temp = $arr[$i];
        if ($username == $temp->username) {
            echo "hello ".$username;

            echo "task ".$temp->daily_task;
            break;
        }
    }
    return view('welcome');
}
    public function store(Request $request)
    {
        $product = [
            'id' => $request->id,
            'daily_task' => $request->daily_task,
        ];
        Daily_tasks::insert($product);
        if (Daily_tasks::all()->count() != 0) {
            echo "saved";
        }
        return view('welcome');
    }
}
