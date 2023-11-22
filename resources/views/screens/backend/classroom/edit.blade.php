@extends('layouts.backend.master')

@section('title', 'Trang Quản Trị')

@section('content')
    <div class="card card-custom">
        <div class="card-header">
            <h3 class="card-title">
                Input States
            </h3>
        </div>
        <!--begin::Form-->
        <form class="form" action="{{ route('classroom.update',$classroom->id) }}" method="post" enctype="multipart/form-data">
            <div class="card-body">
                <div class="form-group form-group-last">

                </div>
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" class="form-control " name="name" id='name'
                        value='{{ isset($classroom) ? $classroom->name : old('name') }}' placeholder="">
                    @error('name')
                        <span class="text-danger"> {{ $message }}</span>
                    @enderror

                </div>

                <div class="form-group">
                    <label for="">Desc</label>
                    <textarea class="form-control" name="desc"rows="3">{{ isset($classroom) ? $classroom->desc : old('name') }}
                    </textarea>
                    @error('desc')
                        <span class="text-danger"> {{ $message }}</span>
                    @enderror

                </div>
                <div class="form-group">

                </div>

                <div class="form-group d-flex">

                        <div class="image-input image-input-empty image-input-outline" id="img_2"
                            style="background-image: url({{asset( $classroom->image)}})">
                            <div class="image-input-wrapper"></div>

                            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                data-action="change" data-toggle="tooltip" title=""
                                data-original-title="Change avatar">
                                <i class="fa fa-pen icon-sm text-muted"></i>
                                <input type="file" name="image" accept=".png, .jpg, .jpeg" />
                                <input type="hidden" name="image_remove" />
                            </label>

                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                            </span>

                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                data-action="remove" data-toggle="tooltip" title="Remove avatar">
                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                            </span>
                        </div>
                        @error('image')
                            <span class="text-danger"> {{ $message }}</span>
                        @enderror

                </div>

                <div class="form-group">
                    <label for="">Status</label>
                    <select name="status" class="form-control">
                        @if ($classroom->status == 1)
                            <option value="1" selected>Hiện </option>
                            <option value="0" >Ẩn</option>
                        @else
                            <option value="1">Hiện </option>
                            <option value="0" selected>Ẩn</option>
                        @endif
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Khóa học</label>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th></th>
                                <th>name</th>
                                <th>title</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($course as $item)
                            <tr>
                                <td>
                                    <input type="checkbox"
                                    @foreach ($classroom->courses as $item1)
                             @if ($item->id == $item1->id) checked
                             @endif @endforeach
                                    value="{{ $item->id }}" name="checkbox[]" />
                                </td>
                                <td>{{$item->title}}</td>
                                <td>{{$item->content}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="card-footer">
                <button class="btn btn-primary mr-2">Submit</button>
              <a class="btn btn-success"  href="{{route('classroom.index')}}">Cancel</a>
            </div>
        </form>
        <!--end::Form-->
    </div>
@endsection
@section('custom-js-tag')
    <script>
        var avatar2 = new KTImageInput('img_2');
    </script>
@endsection
