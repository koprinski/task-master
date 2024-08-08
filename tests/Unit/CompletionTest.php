<?php

namespace Tests\Unit;

use App\Jobs\UpdateDailyTasks;
use App\Models\DailyTask;
use Tests\TestCase;

class CompletionTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_checkDailyTaskCompletion(): void
    {
       $dailytasks = DailyTask::factory()->count(5)->completed()->create();

       $respone = app(UpdateDailyTasks::class)->checkForUncompletedTasks($dailytasks);

       $this->assertFalse($respone);
    }
}
