<?php

namespace Tests\Feature;

use App\Jobs\Remind;
use App\Mail\Reminder;
use App\Models\DailyTask;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class MailTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_reminder_mailable_content()
    {
        $user = User::factory()->create();

        $mailable = new Reminder($user);

        $mailable->assertHasSubject('You have unfinished tasks!');
        $mailable->assertSeeInHtml($user->name);
    }

    public function test_job_sends_reminder_emails_to_users_with_unfinished_tasks()
    {
        Mail::fake();
        $user = User::factory()->create();
        $task = DailyTask::factory()->create(['user_id' => $user->id]);

        $this->travelTo(now()->setTimezone('America/New_York')->setTime(17, 30));
        app(Remind::class)->handle();

        Mail::assertSent(Reminder::class, function ($mail) use ($user) {
            return $mail->hasTo($user->email);
        });
    }

    public function test_job_sends_reminder_emails_to_users_with_no_unfinished_tasks()
    {
        Mail::fake();
        $user = User::factory()->create();
        $task = DailyTask::factory()->completed()->create(['user_id' => $user->id]);

        $this->travelTo(now()->setTimezone('America/New_York')->setTime(17, 30));
        app(Remind::class)->handle();

        Mail::assertNotSent(Reminder::class);
    }

    public function test_job_sends_reminder_emails_to_users_outside_timezone()
    {
        Mail::fake();
        $user = User::factory()->create();
        $task = DailyTask::factory()->create(['user_id' => $user->id]);

        $this->travelTo(now()->setTimezone('America/New_York')->setTime(13, 30));
        app(Remind::class)->handle();

        Mail::assertNotSent(Reminder::class);

    }
}
