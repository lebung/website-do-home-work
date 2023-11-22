@extends('layouts.backend.master')

@section('title', 'Thêm Khóa Học')

@section('title-heading', 'Thêm Khóa Học')

@section('content')
<div class="row">
    <div class="col-md-12">
        @if (session()->has('error'))
            <div class="alert alert-danger text-center">{{ session()->get('error') }}</div>
        @endif
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-header">
                <h3 class="card-title">Thêm Khóa Học</h3>
            </div>
            <!--begin::Form-->
            <form method="POST" enctype="multipart/form-data" action="{{ route('admin.course.store') }}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label>Tiêu đề
                            <span class="text-danger">*</span></label>
                        <input type="text" value="{{ old('title') }}" name="title" class="form-control" placeholder="Nhập tiêu đề">
                        @error('title')
                            <p class="text-danger">{{ $message }}</p>    
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Đường dẫn
                            <span class="text-danger">*</span></label>
                        <input value="{{ old('slug') }}" type="text" name="slug" class="form-control" placeholder="Đường dẫn">
                        @error('slug')
                            <p class="text-danger">{{ $message }}</p>    
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Mô tả</label>
                        <textarea name="content" rows="5" class="form-control">{{ old('content') }}</textarea>
                        @error('content')
                            <p class="text-danger">{{ $message }}</p>    
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Danh mục</label>
                        <select name="category_id" class="form-control">
                            <option value="">Chọn danh mục</option>
                            @foreach ($categories as $cat)
                                <optgroup label="{{ $cat->name }}">
                                @foreach ($cat->childs as $c)
                                    <option value="{{ $c->id }}" @if($c->id == old('category')) selected @endif>{{ $c->name }}</option>
                                @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-danger">{{ $message }}</p>    
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Ảnh slide</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input file-image" name="thumbnail" accept=".png, .jpg, .jpeg, .jfif, .webp" id="customFile">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                        @error('image')
                            <p class="text-danger">{{$message}}</p>    
                        @enderror
                        <div class="preview-image new"></div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Trạng thái</label>
                        <div class="col-9 col-form-label">
                            <div class="radio-inline">
                                <label class="radio">
                                <input type="radio" value="1" name="status" checked>
                                <span></span>Công khai</label>
                                <label class="radio">
                                <input type="radio" value="0" name="status" @checked(!empty(old()) && !old('status'))>
                                <span></span>Riêng tư</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Tiến độ học bắt buộc (không tính tiến độ = 0)</label>
                        <input type="text" name="config" value="0" min="0" max="100" placeholder="Nhập tiến độ bắt buộc" class="form-control">
                        @error('config')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary mr-2">Thêm</button>
                        <a href="" class="btn btn-success mr-2">Danh sách slider</a>
                    </div>
                </div>
            </form>
            <!--end::Form-->
        </div>
    </div>
</div>
@endsection

@section('custom-js-tag')
    <script>
        $(document).ready(function(){
            CKEDITOR.replace('content')

            $('[name="title"]').blur(function(){
                let title = $(this).val()
                $('[name="slug"]').val(ChangeToSlug(title))
            })
        })
    </script>
@endsection