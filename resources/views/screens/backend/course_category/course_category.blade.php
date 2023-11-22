@extends('layouts.backend.master')

@section('title', 'Danh mục Khóa học')

@section('content')
    <div class="card card-custom gutter-b">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">Danh mục khóa học</h3>
            </div>
        </div>
        <div class="card-body">
            <div class="example mb-10">
                <div class="row align-items-center">
                    <div class="col-lg-9 col-xl-10">
                        <div class="row align-items-center m-2">
                            <div class="col-md-4 my-2 my-md-0">
                                <div class="input-icon">
                                    <input type="text" class="form-control" placeholder="Tìm kiếm..." id="search"
                                        name="search" />
                                    <span>
                                        <i class="flaticon2-search-1 text-muted"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-4 my-2 my-md-0">
                                <div class="d-flex align-items-center">
                                    <label class="mr-3 mb-0 d-none d-md-block">Status:</label>
                                    <select class="form-control" id="kt_datatable_search_status">
                                        <option value="">Tất cả</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xl-2 mt-5 mt-lg-0">
                        <a href="#" data-toggle="modal" data-target="#addcourse_categoryModal"
                            class="btn btn-light-primary px-6 font-weight-bold">Thêm mới</a>
                    </div>
                </div>
                <div class="example-preview">
                    <div class="row">
                        @foreach ($course_category as $item)
                            <div class="col-md-6 col-lg-6 col-xl-4 on-hover-action mt-4" id="1">
                                <div class="card d-block">
                                    <img class="card-img-top" src="{{ asset($item->thumbnail) }}" height="300px" alt="Card image cap">
                                    <div class="card-body">
                                        <h4 class="card-title mb-0">{{ $item->name }}</h4>
                                        <small style="font-style: italic;">
                                            <p class="card-text"></p>
                                        </small>
                                    </div>
                                    <ul class="list-group list-group-flush">
                                        @foreach ($item->childs as $item1)
                                            <li class="list-group-item on-hover-action" id="2">
                                                <span><i class="ki ki-plus mr-2 text-info"></i>{{ $item1->name }}
                                                    <div style="float: right;">

                                                        <a href="#" data-toggle="modal" data-target="#editItemModal"
                                                            onclick="javascript:editItem({{ $item1 }})"> <i
                                                                class="ki ki-wrench"></i></a>
                                                    </div>

                                                </span>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="card-body">
                                        <a href="" data-toggle="modal" data-target="#exampleModal"
                                            onclick="javascript:edit_course_category({{ $item }})"
                                            class="btn btn-outline-info btn-sm">
                                            <i class="ki ki-wrench btn-outline-info"></i> Edit </a>
                                        <a href="#" class="btn btn-outline-success btn-sm "
                                            onclick="javascript:add_courseItem({{ $item }})" data-toggle="modal"
                                            data-target="#addItemModal" style="float: right;">
                                            <i class="ki ki-plus btn-outline-success"></i> Add Item </a>
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">

            <div class="dataTables_paginate paging_simple_numbers">
                {{ $course_category->links('pagination::bootstrap-5') }}
            </div>

        </div>
    </div>
    </div>
    </div>
    <div class="container">
        {{-- {{$course_category->links()}} --}}
    </div>
    @include('layouts.blade_api.modal_course_category');
@endsection

@section('custom-js-tag')
    @include('layouts.blade_api.js.js_course_category')
@endsection
