<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class UserController extends Controller
{
    public function upload(Request $request)
    {
        if ($request->hasFile('image')){
            $file =$request->file('image');
            $file->storeAs('public/avatars',$file->getClientOriginalName());
            Auth()->user()->update(['image'=> $file->getClientOriginalName()]);
        }

        return redirect('habits');
    }
}
