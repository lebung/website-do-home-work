@extends('layouts.backend.master')

@section('title', 'Danh Sách Khóa Học')

@section('title-heading', 'Danh Sách Khóa Học')

@section('content')
<div class="row">
    <div class="col-md-12">
        @if (session()->has('success'))
        <div class="alert alert-success text-center">{{ session()->get('success') }}</div>
        @endif
        @if (session()->has('error'))
        <div class="alert alert-danger text-center">{{ session()->get('error') }}</div>
        @endif
        <!--begin::table-->
        <a href="{{ route('admin.course.create') }}" class="btn btn-primary mr-2 mb-3">Thêm khóa học</a>
        <div class="card card-custom gutter-b">
            <div class="card-body">
                <form action="">
                    <!--begin::Search Form-->
                    <div class="mb-7">
                        <div class="row align-items-center">
                            <div class="col-lg-10 col-xl-10">
                                <div class="row align-items-center">
                                    <div class="col-md-4 my-2 my-md-0">
                                        <div class="input-icon">
                                            <input type="text" name="q" class="form-control" value="{{ request()->query('q') ?: '' }}" placeholder="Nhập tên..." />
                                            <span>
                                                <i class="flaticon2-search-1 text-muted"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 my-2 my-md-0">
                                        <div class="d-flex align-items-center">
                                            <label class="mr-3 mb-0 d-none d-md-block">Danh mục:</label>
                                            <select name="category" class="form-control">
                                                <option value="">Tất cả</option>
                                                @foreach ($categories as $cat)
                                                    <optgroup label="{{ $cat->name }}">
                                                    @foreach ($cat->childs as $c)
                                                        <option value="{{ $c->slug }}" {{ request()->query('category') == $c->slug ? 'selected' : '' }}>{{ $c->name }}</option>
                                                    @endforeach
                                                    </optgroup>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 my-2 my-md-0">
                                        <div class="d-flex align-items-center">
                                            <label class="mr-3 mb-0 d-none d-md-block">Trạng thái:</label>
                                            <select name="status" class="form-control">
                                                <option value="" selected>Tất cả</option>
                                                <option value="1" {{ request()->query('status') == "1" ? 'selected' : '' }}>Công khai</option>
                                                <option value="0" {{ request()->query('status') == "0" ? 'selected' : '' }}>Riêng tư</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-xl-2 mt-5 mt-lg-0">
                                <button class="btn btn-light-primary px-6 font-weight-bold">Lọc</button>
                            </div>
                        </div>
                    </div>
                    <!--end::Search Form-->
                </form>
                {{-- <!--begin: Datatable-->
                <div class="datatable datatable-default datatable-bordered datatable-loaded">
                    <table class="table table-head-custom table-head-bg table-borderless table-vertical-center">
                        <thead class="datatable-head">
                            <tr class="datatable-row" style="left: 0px;">
                                <th class="datatable-cell" style="flex-grow:1"><span>Tên khóa học</span></th>
                                <th class="datatable-cell" style="width: 15%"><span>Danh mục</span></th>
                                <th class="datatable-cell" style="width: 15%"><span>Thống kê</span></th>
                                <th class="datatable-cell" style="width: 10%"><span>Người học</span></th>
                                <th class="datatable-cell" style="width: 15%"><span>Trạng thái</span></th>
                                <th class="datatable-cell text-right" style="width: 15%"><span>Tùy chọn</span></th>
                            </tr>
                        </thead>
                        <tbody id="table-categories" class="datatable-body">
                            @foreach ($courses as $course)
                            <tr class="datatable-row" style="left: 0px;">
                                <td class="datatable-cell font-weight-bolder" style="flex-grow:1"><span>{{ $course->title }}</span></td>
                                <td class="datatable-cell font-weight-bolder" style="width: 15%"><span>{{ $course->category->name }}</span></td>
                                <td class="datatable-cell font-weight-bolder" style="width: 15%"><span>
                                    <p>Chương học: {{ $course->sections->count() }}</p>
                                    <p>Bài học: {{ $course->lessons->count() }}</p>
                                </span></td>
                                <td class="datatable-cell font-weight-bolder" style="width: 10%"><span>{{ $course->users->count() }}</span></td>
                                <th class="datatable-cell" style="width: 15%"><span class="label font-weight-bold label-lg {{ $course->status == 1 ? 'label-success' : 'label-warning' }} label-rounded label-inline">{{ config("common.course_status.{$course->status}") }}</span></th>
                                <td class="datatable-cell text-right" style="width: 15%"><span>
                                    <div class="btn-group dropleft">
                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></button>
                                        <div class="dropdown-menu" style="">
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="{{ route('admin.course.edit', $course->id) }}">Chỉnh sửa</a>
                                            <form action="{{ route('admin.course.changestatus', $course->id) }}" method="POST" class="dropdown-item">
                                                @csrf
                                                @method('PATCH')
                                                <button class="btn btn-link-dark">Thay đổi trạng thái</button>
                                            </form>
                                            <div class="dropdown-divider"></div>
                                            <form action="{{ route('admin.course.delete', $course->id) }}" method="POST" class="dropdown-item">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-link-danger btn-block text-left delete-item">Xóa</button>
                                            </form>
                                        </div>
                                    </div>
                                </span></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> --}}

            </div>
        </div>

        <div class="row">
            @foreach ($courses as $course)
                <!--begin::Col-->
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                <!--begin::Card-->
                <div class="card card-custom gutter-b card-stretch">
                    <!--begin::Body-->
                    <div class="card-body pt-4">
                        <!--begin::Toolbar-->
                        <div class="d-flex justify-content-end">
                            <div class="dropdown dropdown-inline">
                                <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="ki ki-bold-more-hor"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                                    <!--begin::Navigation-->
                                    <ul class="navi navi-hover">
                                        <a class="dropdown-item" href="{{ route('admin.course.edit', $course->id) }}">Chỉnh sửa</a>
                                        <form action="{{ route('admin.course.changestatus', $course->id) }}" method="POST" class="dropdown-item">
                                            @csrf
                                            @method('PATCH')
                                            <button class="btn btn-link-dark">Thay đổi trạng thái</button>
                                        </form>
                                        <div class="dropdown-divider"></div>
                                        {{-- <form action="{{ route('admin.course.delete', $course->id) }}" method="POST" class="dropdown-item">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-link-danger btn-block text-left delete-item">Xóa</button>
                                        </form> --}}
                                    </ul>
                                    <!--end::Navigation-->
                                </div>
                            </div>
                        </div>
                        <!--end::Toolbar-->
                        <!--begin::User-->
                        <div class="d-flex align-items-center mb-7" style="aspect-ratio:1/1;overflow:hidden">
                            <img src="{{ getPathImage($course->thumbnail) }}" style="width: 100%;height:100%;object-fit:cover" alt="image">
                        </div>
                        <!--end::User-->
                        <!--begin::Desc-->
                        <h4 class=" mb-7 font-weight-bold"><a class="text-dark text-hover-primary" href="{{route('report.report_course',$course->id)}}">{{ $course->title }}</a> </h4>
                        <!--end::Desc-->
                        <!--begin::Info-->
                        <div class="mb-7">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-dark-75 mr-2">Danh mục</span>
                                <span class="text-dark font-weight-bolder text-hover-primary">{{ $course->category->name }}</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-cente my-1">
                                <span class="text-dark-75 mr-2">Chương học</span>
                                <span class="text-dark font-weight-bolder text-hover-primary">{{ $course->sections->count() }}</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-dark-75 mr-2">Bài học</span>
                                <span class="text-dark font-weight-bolder font-weight-bold">{{ $course->lessons()->count() }}</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-dark-75 mr-2">Trạng thái</span>
                                <span class="{{ $course->status == 1 ? 'text-success' : 'text-warning' }} font-weight-bolder">{{ config("common.course_status.{$course->status}") }}</span>
                            </div>
                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end:: Card-->
            </div>
            <!--end::Col-->
            @endforeach
        </div>

        <div class="card card-custom">
            <div class="card-footer d-flex justify-content-between align-items-center">
                <p style="margin: unset">Kết quả tìm thấy {{ $courses->count() }} trên tổng số {{ $courses->total() }} sản phẩm</p>
                {{ $courses->withQueryString()->links('layouts.backend.pagination') }}
            </div>
        </div>
        <!--end::table-->
    </div>
</div>
@endsection
