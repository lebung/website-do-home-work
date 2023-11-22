<?php

namespace Tests\Feature\Admin;

use App\Models\Classroom;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserClassroomControllerTest extends TestCase
{
    private $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = ['email' => 'admin@example.com', 'password' => '12345678'];
        $response = $this->post(route('auth.processLogin'), $this->user);
    }    

    public function test_index(){
        $response = $this->get(route('admin.userclass.list', Classroom::find(1)));
        $response->assertStatus(302);

    }

    public function test_add_student(){
        $response = $this->get(route('admin.userclass.addStudent',1));
        $response->assertStatus(302);
    }

}
