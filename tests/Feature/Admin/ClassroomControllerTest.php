<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ClassroomControllerTest extends TestCase
{
    // private $user;

    // protected function setUp(): void
    // {
    //     parent::setUp();
    //    $this->user=['email'=>'admin@example.com' ,'password'=>'12345678'];
    //    $response=$this->post(route('auth.processLogin'),$this->user);
    //    $response
    //    ->assertStatus(302)
    //    ->assertRedirect(route('frontend.home'));
    // }

    // /**
    //  * A basic feature test example.
    //  *
    //  * @return void
    //  */
    // public function test_classroom()
    // {
    //     $response = $this->get(route('classroom.index'));
    //     $response->assertStatus(200);
    //     $response->assertSeeText('classroom');
    // }



    // public function test_store_classroom_is_invalid(){
    //     $params=[
    //         'name'=>null,
    //         'desc'=>"jcbd jlcad",
    //         'image'=>"image.jpg",
    //     ];
    //     $response = $this->post(route('classroom.store'),$params);
    //     $response
    //     ->assertStatus(302)
    //     ->assertSessionHasErrors('name');

    // }
    // public function test_creat(){
    //     $response = $this->get(route('classroom.form_store_classroom'));
    //     $response->assertStatus(200);
    //     $response->assertSeeText('name');

    // }
    // public function test_classroom_store(){
    //     $params=[
    //         'name'=>"bungbung",
    //         'desc'=>"jcbd jlcad jsbsdks",
    //         'image'=>"images/classroom/volGgyMaJ54JGoDe4qA36Y1Kg45dmfxPiH5s0jbb.jpg",
    //     ];
    //     $response = $this->post(route('classroom.store'),$params);
    //     $response->assertStatus(302);
    //     $response->assertRedirect(route('classroom.index'));
    // }
    // public function test_form_update(){
    //     $response = $this->get(route('classroom.form_update_classroom',1));
    //     $response->assertStatus(200);
    //     $response->assertSeeText('name');

    // }
    // public function test_classroom_update_success(){
    //     $params=[
    //         'name'=>"bungbung",
    //         'desc'=>"jcbd jlcad jsbsdks",
    //         'image'=>"images/classroom/volGgyMaJ54JGoDe4qA36Y1Kg45dmfxPiH5s0jbb.jpg",
    //         'checkbox'=>1
    //     ];
    //     $response = $this->put(route('classroom.update',1),$params);
    //     $response->assertStatus(302);
    //     $response->assertRedirect(route('classroom.index'));
    // }
    // public function test_search(){
    //     $response = $this->get('admin/classroom/search_name');
    //     $response->assertStatus(200);
    // }
    // public function test_fillter(){
    //     $response = $this->get('admin/classroom/fillter');
    //     $response->assertStatus(200);
    // }
}
