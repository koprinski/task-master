<?php

namespace Tests\Feature;

use App\Models\DailyTask;
use App\Models\Habit;
use App\Models\LongTermTask;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_daily_task_page_is_displayed(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/daily');

        $response->assertOk();
    }
    public function test_habit_page_is_displayed(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/habits');

        $response->assertOk();
    }
    public function test_long_task_page_is_displayed(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/longTerm');

        $response->assertOk();
    }

    public function test_insert_daily_task_page_is_displayed(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/iDaily');

        $response->assertOk();
    }
    public function test_insert_habit_page_is_displayed(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/iHabits');

        $response->assertOk();
    }
    public function test_longTask_page_is_displayed(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/iLongTerm');

        $response->assertOk();
    }

    public  function test_close_modal_working(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post('/closeModal');
        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/daily');
        $user->refresh();

        $this->assertTrue($user->fresh()->checkedModal);
    }

    public function test_insert_daily(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post('/iDaily', ['name' => 'task']);
        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/daily');
        $user->refresh();


        $this->assertDatabaseHas('daily_tasks', ['user_id' => $user->id]);
    }

    public function test_insert_habit(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post('/iHabits', ['name' => 'task']);
        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/habits');
        $user->refresh();


        $this->assertDatabaseHas('habits', ['user_id' => $user->id]);
    }

    public function test_insert_long_term(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post('/iLongTerm', ['name' => 'task', 'date' => '09/07/2024']);
        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/longTerm');
        $user->refresh();


        $this->assertDatabaseHas('long_term_tasks', ['user_id' => $user->id]);
    }

    public function test_delete_habit(): void
    {
        $user = User::factory()->create();
        $habit = Habit::factory()->create(['id' => 1 ,'user_id' => $user->id]);


        $response = $this
            ->actingAs($user)
            ->delete('/task.habits/'.$habit->id);


        $this->assertDatabaseMissing('habits', ['id' => $habit->id]);
        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Task deleted successfully',
                'points' => $user->points,
            ]);

    }

    public function test_delete_daily(): void
    {
        $user = User::factory()->create();
        $daily = DailyTask::factory()->create(['id' => 1 ,'user_id' => $user->id]);


        $response = $this
            ->actingAs($user)
            ->delete('/task.daily/'.$daily->id);


        $this->assertDatabaseMissing('daily_tasks', ['id' => $daily->id]);
        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Task deleted successfully',
                'points' => $user->points,
            ]);

    }

    public function test_delete_long(): void
    {
        $user = User::factory()->create();
        $long = LongTermTask::factory()->create(['id' => 1 ,'user_id' => $user->id]);


        $response = $this
            ->actingAs($user)
            ->delete('/task.longTerm/'.$long->id);
         $user->refresh();

        $this->assertDatabaseMissing('long_term_tasks', ['id' => $long->id]);
        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Task deleted successfully',
                'points' => $user->points,
            ]);

    }

    public function test_points_habit_plus(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post('/task.habits/+');

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Points changed successfully',
                'points' => 550,
            ]);
    }

    public function test_points_habit_minus(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post('/task.habits/-');

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Points changed successfully',
                'points' => 400,
            ]);
    }

    public function test_points_complete_daily(): void
    {
        $user = User::factory()->create();
        $daily = DailyTask::factory()->create(['id' => 1 ,'user_id' => $user->id]);


        $response = $this
            ->actingAs($user)
            ->post('/task.daily/'.$daily->id);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Task completed successfully',
                'points' => 600,
                'count' => 1
            ]);
    }


    public function test_points_complete_long(): void
    {
        $user = User::factory()->create();
        $long = LongTermTask::factory()->create(['id' => 1 ,'user_id' => $user->id]);


        $response = $this
            ->actingAs($user)
            ->post('/task.longTerm/'.$long->id);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Task completed successfully',
                'points' => 800,
            ]);
    }

    public function test_upload_profile_pic()
    {
        $user = User::factory()->create();
        $file = UploadedFile::fake()->image('avatar.png');

        $response = $this
            ->actingAs($user)
            ->post('/profile', ['image' => $file]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/habits');
        $user->refresh();

        $this->assertEquals($file->getClientOriginalName(), $user->fresh()->image);
    }



}
