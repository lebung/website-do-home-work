<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CourseControllerTest extends TestCase
{
    private $user;

    protected function setUp(): void
    {
        parent::setUp();
        Artisan::call('db:seed', ['--class'=>'DatabaseSeeder']);
        $this->user = ['email' => 'admin@example.com', 'password' => '12345678'];
        $response = $this->post(route('auth.processLogin'), $this->user);
    }

    public function test_index()
    {
        $response = $this->get(route('admin.course.list'));
        $response->assertSeeText('Danh Sách Khóa Học');
        $response->assertStatus(200);
//        $response->assertRedirect(route('admin.course.list'));
    }

    public function test_create()
    {
        $response = $this->get(route('admin.course.create'));
        $response->assertSeeText('Thêm Khóa Học');
        $response->assertSeeText('Tiêu đề');
        $response->assertSeeText('Đường dẫn');
        $response->assertSeeText('Mô tả');
        $response->assertSeeText('Danh mục');
        $response->assertSeeText('Ảnh slide');
        $response->assertSeeText('Trạng thái');
        $response->assertSeeText('Tiến độ học bắt buộc (không tính tiến độ = 0)');
        $response->assertStatus(200);
    }

    public function test_store()
    {
        $filename = public_path('tests\user.jpg');
        $file = new UploadedFile($filename, 'user.jpg', 'image/jpg', filesize($filename), true, true);

        $data = [
            'title' => 'Khóa học 1',
            'content' => 'Đây là khóa học 1',
            'slug' => '/course',
            'thumbnail' => $file,
            'status' => '1',
            'config' => 1,
            'category_id' => 1
        ];

        $response = $this->post(route('admin.course.store', $data));
        $response->assertStatus(302);
    }

    public function test_edit()
    {
        $response = $this->get(route('admin.course.edit',1));
        $response->assertSeeText('Sửa Khóa Học');
        $response->assertSeeText('Tiêu đề');
        $response->assertSeeText('Đường dẫn');
        $response->assertSeeText('Mô tả');
        $response->assertSeeText('Danh mục');
        $response->assertSeeText('Ảnh slide');
        $response->assertSeeText('Trạng thái');
        $response->assertSeeText('Tiến độ học bắt buộc (không tính tiến độ = 0)');
        $response->assertStatus(200);
    }

    public function test_update(){
        $filename = public_path('tests\user.jpg');
        $file = new UploadedFile($filename, 'user.jpg', 'image/jpg', filesize($filename), true, true);

        $data = [
            'title' => 'Khóa học 2',
            'content' => 'Đây là khóa học 2',
            'slug' => '/course',
            'thumbnail' => $file,
            'status' => '1',
            'config' => 1,
            'category_id' => 1
        ];

        $response = $this->put(route('admin.course.update', 2),$data);
        $response->assertStatus(302);
    }

    public function test_change_status(){
        $data = ['status' => 0];

        $response = $this->patch(route('admin.course.changestatus', 2), $data);
        $response->assertStatus(302);
    }

    public function test_destroy(){
        Artisan::call('db:seed', ['--class'=>'DatabaseSeeder']);
        $response = $this->delete(route('admin.course.delete', 1));
        $response->assertStatus(302);
    }
}
