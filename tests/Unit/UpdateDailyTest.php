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
    public function test_check_daily_task_completion_completed(): void
    {
       $dailytasks = DailyTask::factory()->count(5)->completed()->create();

       $respone = app(UpdateDailyTasks::class)->checkForUncompletedTasks($dailytasks);

       $this->assertFalse($respone);
    }

    public function test_check_daily_task_completion_not_completed(): void
    {
        $dailytasks = DailyTask::factory()->count(5)->create();

        $respone = app(UpdateDailyTasks::class)->checkForUncompletedTasks($dailytasks);

        $this->assertTrue($respone);
    }

    public function test_count_uncompleted_tasks(): void
    {
        $dailytasks = DailyTask::factory()->count(5)->create();

        $response = app(UpdateDailyTasks::class)->countUncompletedTasks($dailytasks);

        $this->assertEquals(5, $response);
    }
    public function test_count_uncompleted_tasks_if_completed(): void
    {
        $dailytasks = DailyTask::factory()->count(5)->completed()->create();

        $response = app(UpdateDailyTasks::class)->countUncompletedTasks($dailytasks);

        $this->assertEquals(0, $response);
    }

    public function test_undo_complete(): void
    {
        $dailyTasks = DailyTask::factory()->count(5)->completed()->create();

        app(UpdateDailyTasks::class)->undoComplete($dailyTasks);

        $this->assertFalse($dailyTasks[0]->fresh()->completed);
        $this->assertEquals(0, $dailyTasks[0]->fresh()->count);

    }


//    public function test_job_processes_users_correctly()
//    {
//        $user = User::factory()->create();
//
//        $dailytask1 = DailyTask::factory()->create(['user_id' => $user->id]);
//        $dailytask2 = DailyTask::factory()->create(['user_id' => $user->id]);
//        $dailytask3 = DailyTask::factory()->completed()->create(['user_id' => $user->id]);
//
//
//        // Mock the current time to be within the range
//        $this->travelTo(now()->setTimezone('America/New_York')->setTime(0, 30));        // Dispatch the job
//        app(UpdateDailyTasks::class)->handle();
//        // Check if the user's points were deducted correctly
//        $user->refresh();
//
//
//        // Check if the user's checkedModal was updated
////        $this->assertFalse($user->checkedModal);
//
//        // Check if the daily tasks were undone
//        $this->assertFalse($dailytask1->fresh()->completed);
//        $this->assertFalse($dailytask2->fresh()->completed);
//        $this->assertFalse($dailytask3->fresh()->completed);
////        $this->assertEquals(200, $user->points);
//    }



}
