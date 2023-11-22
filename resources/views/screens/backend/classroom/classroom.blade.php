@extends('layouts.backend.master')

@section('title', 'Trang Quản Trị')

@section('content')

    <div class="card card-custom gutter-b">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">Classroom</h3>

            </div>
        </div>
        <div class="card-body">
            <!--begin::Example-->
            <div class="example mb-10">

                <div class="row align-items-center">
                    <div class="col-lg-9 col-xl-10">

                        <div class="row align-items-center m-2">
                            <div class="col-md-4 my-2 my-md-0">
                                <div class="input-icon">
                                    <input type="text" class="form-control" placeholder="Search..." id="search"
                                        name="search" />
                                    <span>
                                        <i class="flaticon2-search-1 text-muted"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-4 my-2 my-md-0">
                                <div class="d-flex align-items-center">
                                    <label class="mr-3 mb-0 d-none d-md-block">Author:</label>
                                    <select class="form-control" id="author">
                                        <option value="0">All</option>
                                        @foreach ($user as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    @can('classroom-create')
                    <div class="col-lg-3 col-xl-2 mt-5 mt-lg-0">
                        <a class="btn btn-success" href="{{route('classroom.form_store_classroom')}}">Thêm mới</a>
                    </div>
                    @endcan
                </div>


                <div class="example-preview">

                    <table class="table table-hover mb-6">
                        <thead>
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">Name</th>
                                <th scope="col">Desc</th>
                                <th scope="col">Author</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($classroom as $item)
                                <tr>
                                    <th scope="row">{{ $item->id }}</th>
                                    <td>
                                        <a href="{{route('admin.userclass.list',$item->id)}}">{{ $item->name }}</a>
                                    </td>
                                    <td> {{ substr($item->desc, 0, 30) }}...</td>
                                    <td>{{ $item->author->name }}</td>
                                    <td>
                                        @if ($item->status == 1)
                                            <span
                                                class="label label-inline label-light-primary font-weight-bold">Hiện</span>
                                        @else
                                            <span class="label label-inline label-light-danger font-weight-bold">Ẩn</span>
                                        @endif
                                    </td>
                                    <td class="d-flex">
                                        {{-- <form  action="{{route('classroom.change_status',$item->id)}}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <button class="btn btn-light  btn-sm mr-2"><i class="ki ki-reload text-warning"></i></button>
                                </form> --}}
                                        <a class="btn btn-light  btn-sm mr-2"
                                            id="change_status"onclick="change({{ $item }})"><i
                                                class="ki ki-reload text-warning"></i></a>

                                        <a href="{{route('classroom.form_update_classroom',$item->id)}}" class="btn btn-light  btn-sm"><i class="flaticon2-gear text-primary"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>

            </div>

        </div>
    </div>
    {{ $classroom->links() }}

@endsection

@section('custom-js-tag')
    @include('layouts.blade_api.js.js_classroom')
@endsection
