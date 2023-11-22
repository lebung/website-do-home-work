<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth; 
use App\Models\User;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    private $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = ['email' => 'admin@example.com', 'password' => '12345678'];
        $response = $this->post(route('auth.processLogin'), $this->user);
    }


    public function test_postLogin_if_success()
    {
        $this->post(route('auth.processLogin'), [
            'email' => 'admin@example.com',
            'password' => '12345678',
        ])
        ->assertStatus(302)
        ->assertRedirect(route('frontend.home'));
        // ->assertSessionHas('cartalyst_sentinel');
    }

    public function test_post_register(){
        $this->post(route('auth.processRegister'), [
            'name' => 'quanokok',
            'email' => 'nmqkaka2@gmail.com',
            'avatar' => 'one.jpg',
            'password'=> '$2a$12$KH0lyHqFvLUiAIY3rry1U.buP1ZFXjCO9UCwuUk9vBYOGXMo1HbKS',
            'status' => '1'
        ])
        ->assertStatus(302)
        ->assertRedirect(route('frontend.home'));
    }



    
    public function test_logout()
    {
        $response = $this->get(route('auth.logout'));
        $response->assertStatus(302);
        $response->assertRedirect(route('auth.login'));
    }

    public function test_register(){
        $response = $this->get(route('admin.register'));
        $response->assertStatus(302);
    }

}
