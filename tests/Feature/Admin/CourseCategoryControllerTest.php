<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
class CourseCategoryControllerTest extends TestCase
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

        public function test_course_category(){
            $response = $this->get('admin/course_category/');
            $response->assertStatus(200);
            $response->assertSeeText('Danh mục khóa học');
        }
        public function test_store_course_category_is_invalid(){
            $params=[
                'name'=>null,
                'image'=>"image.jpg",
            ];
            $response = $this->post('admin/course_category/store',$params);
            $response
            ->assertStatus(302)
            ->assertSessionHasErrors('name');

        }
        public function test_course_category_store(){

            $params=[
                'name'=>"bungbung",
                'thumbnail'=>"images/classroom/volGgyMaJ54JGoDe4qA36Y1Kg45dmfxPiH5s0jbb.jpg",
            ];
            $response =$this->post('admin/course_category/store',$params);
            $response->assertStatus(302);
            $response->assertRedirect('admin/course_category/');
        }
        public function test_classroom_update_success(){
            $params=[
                'id'=>1,
                'name'=>"bungbung",
                'thumbnail'=>"images/classroom/volGgyMaJ54JGoDe4qA36Y1Kg45dmfxPiH5s0jbb.jpg",

            ];
            $response = $this->post('admin/course_category/update',$params);
            $response->assertStatus(302);
            $response->assertRedirect(route('admin/course_category/'));
        }
        public function test_search(){
            $response = $this->get('admin/course_category/search_course_category');
            $response->assertStatus(200);
        }
}
