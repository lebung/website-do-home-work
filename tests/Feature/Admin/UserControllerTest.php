<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    private $user;

    protected function setUp(): void
    {
        parent::setUp();
       $this->user=['email'=>'admin@example.com' ,'password'=>'12345678'];
       $response=$this->post(route('auth.processLogin'),$this->user);
       $response
       ->assertStatus(302)
       ->assertRedirect(route('frontend.home'));
    } 

    public function test_index(){
        $response = $this->get(route('admin.user.list-user'));
        
        $response->assertStatus(302);
        
        // $response->assertSeeText('user');
    }

    public function test_edit_user(){
        $response = $this->get(route('admin.user.edit'));
        $response->assertStatus(302);
    }
}
