<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class QuestionAnswerControllerTest extends TestCase
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

   public function test_question_answer(){
    $response = $this->get(route('question.list'));
    $response->assertStatus(200);
    $response->assertSeeText('List Questions');
   }
   public function test_create(){
    $response = $this->get(route('question.list',1));
    $response->assertStatus(200);

   }
   public function test_store(){
    $data=[
        'name'=>'shabshs',
        'desc'=>'sakdbjs',
        'title'=>'sjdbsjd',
        'type'=>1,
        'attachment'=>'hjbhjsdsds',
        'tag'=>'Mrs. Lucinda Kirlin'
    ];
    $response = $this->post(route('classroom.store'),$data);
    $response->assertStatus(302);

   }

}
