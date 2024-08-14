<?php

namespace Tests\Unit;

use App\Jobs\UpdateDailyTasks;
use App\Models\DailyTask;
use App\Models\LongTermTask;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserServiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     */
    public function test_deleteLongTask_date_not_expired(): void
    {
        $user = User::factory()->create(['points'=>500]);
        $userService = new UserService($user['id']);
        $longTask = LongTermTask::factory()->create();

        $response =  $userService->deleteLongTask($longTask['id']);

        $this->assertEquals(500, $response);
        $this->assertDatabaseMissing('long_term_tasks', ['id' => $longTask->id,]);
    }
    public function test_deleteLongTask_date_expired(): void
    {
        $user = User::factory()->create(['points'=>500]);
        $userService = new UserService($user['id']);
        $longTask = LongTermTask::factory()->expired()->create();

        $response =  $userService->deleteLongTask($longTask['id']);

        $this->assertEquals(100, $response);
        $this->assertDatabaseMissing('long_term_tasks', ['id' => $longTask->id,]);
    }

    public function test_changePointsH_plus(): void
    {
        $user = User::factory()->create(['points'=>500]);
        $userService = new UserService($user['id']);
        $response = $userService->changePointsH('+');

        $this->assertEquals(550, $response);
    }

    public function test_changePointsH_minus(): void
    {
        $user = User::factory()->create(['points'=>500]);
        $userService = new UserService($user['id']);
        $response = $userService->changePointsH('-');

        $this->assertEquals(400, $response);
    }

    public function test_changePointsD(): void
    {
        //arrange
        $user = User::factory()->create(['points'=>500]);
        $userService = new UserService($user['id']);
        $dailytask = DailyTask::factory()->create();

        //act
        $response = $userService->changePointsD($dailytask['id']);

        //assert
        $this->assertEquals(600, $response['points']);
        $this->assertEquals(1, $response['count']);
        $this->assertTrue($dailytask->fresh()->completed);
    }

    public function test_changePointsL(): void
    {
        //arrange
        $user = User::factory()->create(['points'=>500]);
        $userService = new UserService($user['id']);
        $longTask = LongTermTask::factory()->create();
        //act
        $response =  $userService->changePointsL($longTask['id']);
        //assert
        $this->assertEquals(800, $response);
        $this->assertDatabaseMissing('long_term_tasks', ['id' => $longTask->id,]);
    }

    public function test_changePointsL_expired(): void
    {
        //arrange
        $user = User::factory()->create(['points'=>500]);
        $userService = new UserService($user['id']);
        $longTask = LongTermTask::factory()->expired()->create();
        //act
        $response =  $userService->changePointsL($longTask['id']);
        //assert
        $this->assertEquals(550, $response);
        $this->assertDatabaseMissing('long_term_tasks', ['id' => $longTask->id,]);
    }

    public function test_checkDailyTaskCompletion_completed(): void
    {
        //arrange
        $dailyTask = DailyTask::factory()->completed()->create();
        $user = User::factory()->create();
        $userService = new UserService($user['id']);

        //act
        $userService->checkDailyTaskCompletion($dailyTask);

        //assert
        $this->assertFalse($dailyTask->fresh()->completed);

    }

    public function test_checkDailyTaskCompletion_not_completed(): void
    {
        //arrange
        $dailyTask = DailyTask::factory()->create();
        $user = User::factory()->create(['points'=>500]);
        $userService = new UserService($user['id']);

        //act
        $userService->checkDailyTaskCompletion($dailyTask);

        //assert
        $this->assertFalse($dailyTask->fresh()->completed);
        $this->assertEquals(350, $user->fresh()->points);
        $this->assertEquals(0, $dailyTask->fresh()->count);

    }

    public function test_closeModal_all_tasks_completed(): void
    {
        //arrange
        $user = User::factory()->create();
        $userService = new UserService($user['id']);
        $dailyTask = DailyTask::factory()->completed()->create(['user_id'=>$user['id']]);

        //act
        $userService->closeModal();

        //assert
        $this->assertTrue($user->fresh()->checkedModal);
        $this->assertFalse($dailyTask->fresh()->completed);
    }
    public function test_closeModal_all_tasks_not_completed(): void
    {
        //arrange
        $user = User::factory()->create();
        $userService = new UserService($user['id']);
        $dailyTask = DailyTask::factory()->create(['user_id'=>$user['id']]);

        //act
        $userService->closeModal();

        //assert
        $this->assertTrue($user->fresh()->checkedModal);
        $this->assertEquals(0, $dailyTask->fresh()->count);
        $this->assertEquals(350, $user->fresh()->points);
        $this->assertFalse($dailyTask->fresh()->completed);
    }
}
