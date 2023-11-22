@extends('layouts.backend.master')

@section('title', 'Sửa Khóa Học')

@section('title-heading', 'Sửa Khóa Học')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-custom gutter-b">
            <div class="card-header card-header-tabs-line justify-content-center">
                <div class="card-toolbar">
                    <ul class="nav nav-tabs nav-bold nav-tabs-line justify-content-center">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#curriculum">
                                <span class="nav-icon"><i class="fas fa-align-left"></i></span>
                                <span class="nav-text">Chương Trình Học</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#info">
                                <span class="nav-icon"><i class="far fa-bookmark"></i></span>
                                <span class="nav-text">Thông Tin Khóa Học</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="curriculum" role="tabpanel" aria-labelledby="kt_tab_pane_1_4">
                        
                        <div class="d-flex align-items-center p-4 justify-content-center mb-5" style="column-gap:15px">
                            <button type="button" class="btn btn-outline-primary btn-pill" onclick="showAjaxModal('{{ route('admin.section.create') }}', 'Thêm chương học')" data-toggle="modal" data-target="#modal-example"><i class="fas fa-plus"></i> Thêm chương học</button>
                            <button type="button" class="btn btn-outline-primary btn-pill" onclick="showAjaxModal('{{ route('admin.lesson.selecttype', $course->id) }}', 'Thêm bài học')" data-toggle="modal" data-target="#modal-example"><i class="fas fa-plus"></i> Thêm bài học</button>
                            <button type="button" class="btn btn-outline-primary btn-pill" onclick="showAjaxModal('{{ route('admin.section.sort', $course->id) }}', 'Sắp xếp chương học')" data-toggle="modal" data-target="#modal-example"><i class="fas fa-sort-amount-down-alt"></i> Sắp xếp chương học</button>
                        </div>
                        @foreach ($course->sections as $key => $s)
                        <div class="card bg-light card-custom gutter-b">
                            <div class="card-header">
                                <div class="card-title">
                                    <h4 class="card-label">
                                    Chương {{ ++$key }}: {{ $s->title }}
                                    </h4>
                                </div>
                                <div class="card-toolbar">
                                    <div class="card-toolbar">
                                        <a data-toggle="modal" data-target="#modal-example" onclick="showAjaxModal('{{ route('admin.section.edit', $s->id) }}', 'Sửa chương học')" class="btn btn-icon btn-sm btn-primary mr-1">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a data-toggle="modal" data-target="#modal-example" onclick="showAjaxModal('{{ route('admin.lesson.sort', $s->id) }}', 'Sắp xếp bài học')" class="btn btn-icon btn-sm btn-success mr-1">
                                            <i class="fas fa-sort-amount-down-alt"></i>
                                        </a>
                                        <form action="{{ route('admin.section.delete', $s->id) }}" method="POST" class="d-inline">
                                            @csrf 
                                            @method('DELETE')
                                            <button class="btn btn-icon btn-sm btn-danger delete-item">
                                                <i class="ki ki-close icon-nm"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                @foreach ($s->lessons as $key => $l)
                                <div class="col-md-12 mb-3">
                                    <span class="bg-white d-flex p-5 d-flex justify-content-between align-items-center">
                                        <p class="lession-name m-0 font-weight-bold">
                                            @if ($l->lesson_type == 'document')
                                                <i class="fas fa-file"></i>
                                            @elseif ($l->lesson_type == 'text')
                                                <i class="fas fa-font"></i>
                                            @elseif ($l->lesson_type == 'video' && $l->video_type == 'system')
                                                <i class="fas fa-video"></i>
                                            @elseif ($l->lesson_type == 'video' && $l->video_type == 'youtube')
                                                <i class="fab fa-youtube"></i>
                                            @endif
                                            Bài học {{ $key+1 }} : {{ $l->title }}</p>
                                        <form action="{{ route('admin.lesson.delete', $l->id) }}" method="POST" id="delete-lesson{{ $l->id }}" class="d-inline" hidden>
                                            @method('DELETE')
                                            @csrf
                                        </form>
                                        <p class="lession-tool m-0">
                                            <a onclick="showAjaxModal('{{ route('admin.lesson.edit', $l->id) }}', 'Chỉnh sửa bài học')" data-toggle="modal" data-target="#modal-example" class="btn btn-text-dark-50 btn-icon-primary font-weight-bold btn-hover-bg-light">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-text-dark-50 btn-icon-danger font-weight-bold btn-hover-bg-light" onclick="showAjaxModal('{{ route('admin.lesson.quiz', $l->id) }}', 'Thêm quiz cho bài học')" data-toggle="modal" data-target="#modal-example"><i class="flaticon-questions-circular-button"></i></button>
                                            <button form="delete-lesson{{ $l->id }}" class="btn btn-text-dark-50 btn-icon-danger font-weight-bold btn-hover-bg-light delete-item">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </p>
                                    </span>
                                </div>
                                @if ($l->quizs->count() > 0)
                                    @foreach ($l->quizs as $quiz)
                                    <div class="col-md-12 mb-3">
                                        <div class="col-md-11 offset-1 p-0">
                                            <span class="bg-white d-flex p-5 d-flex justify-content-between align-items-center">
                                                <p class="lession-name m-0 font-weight-bold"><i class="flaticon-questions-circular-button"></i> Quiz: {{ $quiz->title }}</p>
                                            </span>
                                        </div>
                                    </div>
                                    @endforeach
                                @endif
                                @endforeach
                            </div>
                        </div>
                        @endforeach

                    </div>
                    <div class="tab-pane fade" id="info" role="tabpanel" aria-labelledby="kt_tab_pane_2_4">
                        
                        <form method="POST" enctype="multipart/form-data" action="{{ route('admin.course.update', $course->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label>Tiêu đề
                                    <span class="text-danger">*</span></label>
                                <input type="text" value="{{ $course->title }}" name="title" class="form-control" placeholder="Nhập tiêu đề">
                                @error('title')
                                    <p class="text-danger">{{ $message }}</p>    
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Đường dẫn
                                    <span class="text-danger">*</span></label>
                                <input value="{{ $course->slug }}" type="text" name="slug" class="form-control" placeholder="Đường dẫn">
                                @error('slug')
                                    <p class="text-danger">{{ $message }}</p>    
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Mô tả</label>
                                <textarea name="content" rows="5" class="form-control">{{ $course->content }}</textarea>
                                @error('content')
                                    <p class="text-danger">{{ $message }}</p>    
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Danh mục</label>
                                <select name="category_id" id="select2" class="form-control">
                                    <option value="">Chọn danh mục</option>
                                    @foreach ($categories as $cat)
                                        <optgroup label="{{ $cat->name }}">
                                        @foreach ($cat->childs as $c)
                                            <option value="{{ $c->id }}" @if($c->id == $course->category_id) selected @endif>{{ $c->name }}</option>
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
                                <div class="preview-image old">
                                    <img src='/{{ $course->thumbnail }}' style='display:block;margin:10px auto 0;width: auto;height: 150px;object-fit:cover;border:1px solid #3699ff;border-radius:5px;'>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label">Trạng thái</label>
                                <div class="col-9 col-form-label">
                                    <div class="radio-inline">
                                        <label class="radio">
                                        <input type="radio" value="1" name="status" @checked($course->status == 1)>
                                        <span></span>Công khai</label>
                                        <label class="radio">
                                        <input type="radio" value="0" name="status" @checked($course->status == 0)>
                                        <span></span>Riêng tư</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Tiến độ học bắt buộc (không tính tiến độ = 0)</label>
                                <input type="text" name="config" value="{{ $course->config }}" min="0" max="100" placeholder="Nhập tiến độ bắt buộc" class="form-control">
                                @error('config')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary mr-2">Cập nhật</button>
                                <a href="" class="btn btn-success mr-2">Danh sách slider</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modal add section -->
<!-- Modal-->
<div class="modal fade" id="modal-example" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Loading...</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom-js-tag')
    <script>
        function showAjaxModal(url, title){
            $('#modal-example').find('.modal-title').text(title)
            $('#modal-example').find('.modal-body').html('<div class="spinner spinner-primary spinner-lg p-15 spinner-center"></div>')
            $.ajax({
                url: url,
                timeout: 1000,
                data: {course: {{ $course->id }}},
                success: function(res){
                    $('#modal-example').find('.modal-body').html(res.html)
                }
            })
        }
        $(document).ready(function(){
            CKEDITOR.replace('content')

            $('[name="title"]').blur(function(){
                let title = $(this).val()
                $('[name="slug"]').val(ChangeToSlug(title))
            })

            $('[data-toggle="tab"]').click(function(){
                let hash = $(this).attr('href')
                history.pushState({}, "", hash)
                // return false
            })

            $('#select2').select2({
                placeholder: 'Chọn danh mục'
            })

            $('[data-target="#add-section"]').click(function(){
                $('#form-add-section').find('input[name="id"]').val('')
            })

            // click tab if has tab
            let tab = window.location.hash
            if(tab != ''){
                $('[data-toggle="tab"][href="'+ tab +'"]').trigger('click')
            }

            $(document).on('submit', 'form.has-validation-ajax', function(e){
                e.preventDefault()
                $(this).find('.errors').text('')
                let _form = $(this)
                let data = new FormData(this)
                let _url = $(this).attr('action')
                let _method = $(this).attr('method')
                let _redirect = $(this).data('redirect') ?? ""
                $.ajax({
                    url: _url,
                    type: _method,
                    data: data,
                    contentType: false,
                    processData: false,
                    success: function(res){
                        window.location.href= _redirect
                    },
                    error: function(err){
                        $('p.errors.system').text('Có lỗi xảy ra, vui lòng thử lại')
                        let errors = err.responseJSON.errors
                        Object.keys(errors).forEach(key => {
                            $(_form).find('.errors.' + key.replace('\.', '')).text(errors[key][0])
                        })
                    }
                })
            })

            setTimeout(() => {
                @if (session()->has('error'))
                salert('error', '{{ session()->get('error') }}')
                @endif
                @if (session()->has('success'))
                salert('success', '{{ session()->get('success') }}')
                @endif
            }, 1200);

        })
    </script>
@endsection