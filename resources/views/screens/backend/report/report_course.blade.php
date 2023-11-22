@extends('layouts.backend.master')

@section('title', 'Trang Quản Trị')

@section('content')

    <div class="card card-custom gutter-b">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">Báo cáo theo khóa học</h3>
                {{-- <a class="btn btn-success" href="{{route('report.report_user')}}">Report User</a> --}}
            </div>
        </div>
        <div class="card-body">
            <!--begin::Example-->
            <div class="example mb-10">

                <div class="example-preview">

                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Student Name</th>
                                <th scope="col">Progress</th>
                                <th scope="col">courses</th>
                                <th scope="col">Enrolled date</th>
                                <th scope="col">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($course->users as $item)
                                <tr>
                                    <th scope="row">{{ $item->id }}</th>
                                    <td>{{ $item->name }}</td>
                                    <td>

                                        <div class="progress" data-toggle="tooltip" data-theme="dark" title="Dark theme">
                                            @foreach ($lesson_history as $item1)
                                                @if ($item1->user_id == $item->id)
                                                    <div class="progress-bar"role="progressbar"
                                                        style="width:  {{ ($item1->count / $lesson) * 100 }}%"
                                                        aria-valuenow=" {{ ($item1->count / $lesson) * 100 }}"
                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </td>
                                    <td>
                                        @foreach ($lesson_history as $item1)
                                        @if ($item1->user_id == $item->id)
                                                {{$item1->count}}
                                                @endif
                                       @endforeach
                                      / {{$lesson}}
                                        {{-- <span class="label label-inline label-light-primary font-weight-bold">Pending</span> --}}

                                    </td>
                                    <td>
                                        {{ $item->created_at }}
                                    </td>
                                    <td>
                                        <a class="btn btn-success" href=""><i class="far fa-envelope"></i></a>
                                        <a class="btn btn-danger btn-round mb-0" href=""><i
                                                class="fas fa-ban"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
            <!--end::Example-->
        </div>
    </div>
@endsection
@section('')

@endsection
