<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Daily_tasks extends Model
{
    use HasFactory;


    protected $fillable=[
        'user_id',
        'daily_task',
    ];
}
