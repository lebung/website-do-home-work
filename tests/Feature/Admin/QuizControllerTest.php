<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class QuizControllerTest extends TestCase
{
    private $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = ['email' => 'admin@example.com', 'password' => '12345678'];
        $response = $this->post(route('auth.processLogin'), $this->user);
    }

    public function test_index()
    {
        $response = $this->get(route('admin.quiz.index'));
        $response->assertStatus(200);
        $response->assertSeeText('List Quizzes');
    }

    public function test_create()
    {
        $response = $this->get(route('admin.quiz.create'));

        $response->assertStatus(200);
        $response->assertSeeText('Title');
        $response->assertSeeText('Duration');
        $response->assertSeeText('Limit');
    }

    public function test_store_is_success()
    {
        $data = [
            'title' => 'Quiz số 1',
            'duration' => 30,
            'limit' => 5,
        ];

        $response = $this->post(route('admin.quiz.store'), $data);

        $response->assertStatus(200);
    }

    public function test_edit()
    {
        $response = $this->get(route('admin.quiz.edit', 2));

        $response->assertStatus(200);
        $response->assertSeeText('Title');
        $response->assertSeeText('Duration');
        $response->assertSeeText('Limit');
    }

    public function test_update_is_success()
    {
        $data = [
            'title' => 'Quiz số 1',
            'duration' => 30,
            'limit' => 5,
        ];

        $response = $this->put(route('admin.quiz.edit', 2), $data);

        $response->assertStatus(200);
    }

    public function test_destroy()
    {
        Artisan::call('db:seed', ['--class'=>'DatabaseSeeder']);
        $response = $this->get(route('admin.quiz.destroy', 1));
        $response->assertStatus(200);
    }

    public function test_insert_user()
    {
        $response = $this->post(route('admin.quiz.insert', 2));
        $response->assertStatus(200);
    }

    public function test_insert_class()
    {
        $response = $this->post(route('admin.quiz.insertClass', 2));
        $response->assertStatus(200);
    }
}
