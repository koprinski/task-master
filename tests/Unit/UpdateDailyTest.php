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


    public function test_handle_if_checked_modal_is_true(): void
    {
        $user = User::factory()->create();

        $dailytask1 = DailyTask::factory()->create(['user_id' => $user->id]);
        $dailytask2 = DailyTask::factory()->create(['user_id' => $user->id]);


        $this->travelTo(now()->setTimezone('America/New_York')->startOfDay()->addMinutes(30));
        app(UpdateDailyTasks::class)->handle();
        $user->refresh();


        $this->assertFalse($user->checkedModal);
        $this->assertFalse($dailytask1->fresh()->completed);
        $this->assertFalse($dailytask2->fresh()->completed);
    }

    public function test_handle_if_checked_modal_is_false(): void
    {
        $user = User::factory()->create(['checkedModal' => false]);

        $dailytask1 = DailyTask::factory()->create(['user_id' => $user->id]);
        $dailytask2 = DailyTask::factory()->create(['user_id' => $user->id]);
        $dailytask3 = DailyTask::factory()->completed()->create(['user_id' => $user->id]);


        // Mock the current time to be within the range
        $this->travelTo(now()->setTimezone('America/New_York')->startOfDay()->addMinutes(30));
        app(UpdateDailyTasks::class)->handle();
        // Check if the user's points were deducted correctly
        $user->refresh();


        $this->assertFalse($user->checkedModal);
        $this->assertFalse($dailytask1->fresh()->completed);
        $this->assertFalse($dailytask2->fresh()->completed);
        $this->assertFalse($dailytask3->fresh()->completed);
        $this->assertEquals(200, $user->points);
    }

    public function test_handle_if_all_tasks_completed(): void
    {
        $user = User::factory()->create();
        $dailytask1 = DailyTask::factory()->completed()->create(['user_id' => $user->id]);
        $dailytask2 = DailyTask::factory()->completed()->create(['user_id' => $user->id]);


        $this->travelTo(now()->setTimezone('America/New_York')->startOfDay()->addMinutes(30));
        app(UpdateDailyTasks::class)->handle();
        $user->refresh();


        $this->assertTrue($user->checkedModal);
        $this->assertFalse($dailytask1->fresh()->completed);
        $this->assertFalse($dailytask2->fresh()->completed);
    }
}
