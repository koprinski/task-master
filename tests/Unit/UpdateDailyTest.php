<?php

namespace Tests\Unit;

use App\Jobs\UpdateDailyTasks;
use App\Models\DailyTask;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
class UpdateDailyTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     */
    public function test_checkDailyTaskCompletionCompleted(): void
    {
       $dailytasks = DailyTask::factory()->count(5)->completed()->create();

       $respone = app(UpdateDailyTasks::class)->checkForUncompletedTasks($dailytasks);

       $this->assertFalse($respone);
    }

    public function test_checkDailyTaskCompletionNotCompleted(): void
    {
        $dailytasks = DailyTask::factory()->count(5)->create();

        $respone = app(UpdateDailyTasks::class)->checkForUncompletedTasks($dailytasks);

        $this->assertTrue($respone);
    }

    public function test_countUncompletedTasks(): void
    {
        $dailytasks = DailyTask::factory()->count(5)->create();

        $response = app(UpdateDailyTasks::class)->countUncompletedTasks($dailytasks);

        $this->assertEquals(5, $response);
    }
    public function test_countUncompletedTasksIfCompleted(): void
    {
        $dailytasks = DailyTask::factory()->count(5)->completed()->create();

        $response = app(UpdateDailyTasks::class)->countUncompletedTasks($dailytasks);

        $this->assertEquals(0, $response);
    }


}
