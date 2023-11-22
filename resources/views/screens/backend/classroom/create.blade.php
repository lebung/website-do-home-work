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
        <form class="form" action="{{route('classroom.store')}}" method="post" enctype="multipart/form-data">
            <div class="card-body">
                <div class="form-group form-group-last">

                </div>
                @csrf
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" class="form-control " name="name" id='name'
                        value='{{ old('name') }}' placeholder="">
                    @error('name')
                        <span class="text-danger"> {{ $message }}</span>
                    @enderror

                </div>

                <div class="form-group">
                    <label for="">Desc</label>
                    <textarea class="form-control" name="desc" id="desc" rows="3"></textarea>
                    @error('desc')
                        <span class="text-danger"> {{ $message }}</span>
                    @enderror

                </div>
                <div class="form-group">
                    <div class="image-input image-input-empty image-input-outline" id="img_2"
                        style="background-image: url(assets/media/users/blank.png)">
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
                        <option value="1">Hiện </option>
                        <option value="0">Ẩn</option>
                    </select>
                </div>

                {{-- <div class="form-group">
                    <label for="">Các khóa học</label>
                    <div class="form-group">
                        @foreach ($course as $item)

                        <div class="checkbox-list">
                            <label class="checkbox">
                                <input type="checkbox" value="{{$item->id}}"  name="checkbox[]"/>
                                <span></span>
                               {{$item->title}}
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div> --}}
                <div class="form-group">
                    <label > Khóa học</label>
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
                                    <input type="checkbox" value="{{$item->id}}"  name="checkbox[]"/>
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
