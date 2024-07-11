<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;



class TestController extends Controller
{
    public function index()
    {
        $name = request('name');
        return view('test', ['id' => 'index', 'name' => $name]);

    }
    public function show($id)
    {
        $name = request('name');
        return view('test', ['id'=> $id], ['name' => $name]);
    }

}
