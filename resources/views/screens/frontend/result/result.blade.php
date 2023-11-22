@extends('layouts.frontend.master')

@section('title', 'Lớp Học')

@section('plugin-css')
@endsection

@section('content')

    <main>

        <!-- =======================
                                    Page Banner START -->
        <section class="pt-0">
            <div class="container-fluid px-0">
                <div class="card bg-blue h-100px h-md-200px rounded-0"
                    style="background:url(assets/images/pattern/04.png) no-repeat center center; background-size:cover;">
                </div>
            </div>
            <div class="container mt-n4">
                <div class="row">
                    <div class="col-12">
                        <div class="card bg-transparent card-body pb-0 px-0 mt-2 mt-sm-0">
                            <div class="row d-sm-flex justify-sm-content-between mt-2 mt-md-0">
                                <!-- Avatar -->
                                <div class="col-auto">
                                    <div class="avatar avatar-xxl position-relative mt-n3">
                                        <img class="avatar-img rounded-circle border border-white border-3 shadow"

                                            src="{{asset("images/avatar/".Auth::user()->avatar)}}" alt="">
                                        <span
                                            class="badge text-bg-success rounded-pill position-absolute top-50 start-100 translate-middle mt-4 mt-md-5 ms-n3 px-md-3">{{ Auth::user()->name }}</span>

                                    </div>
                                </div>
                                <!-- Profile info -->
                                <div class="col d-sm-flex justify-content-between align-items-center">
                                    <div>
                                        <ul class="list-inline mb-0">
                                            <li class="list-inline-item me-3 mb-1 mb-sm-0 border border-success btn">
                                                <span class="text-body fw-light">Quiz: </span>
                                                <span class="h6"> {{ $quiz->title }}</span>
                                            </li>
                                            <li class="list-inline-item me-3 mb-1 mb-sm-0 border border-success btn">
                                                <span class="text-body fw-light">Score: </span>
                                                <span class="h6"> {{ $quizResult->score }}</span>
                                            </li>
                                            <li class="list-inline-item me-3 mb-1 mb-sm-0 border border-success btn">
                                                <span class="text-body fw-light">Start time</span>
                                                <span class="h6"> {{ $quizResult->start_time }}</span>
                                            </li>
                                            <li class="list-inline-item me-3 mb-1 mb-sm-0 border border-success btn">
                                                <span class="text-body fw-light">End time </span>
                                                <span class="h6">{{ $quizResult->end_time }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="card-body container">

            <!-- Title -->
            <h5>Chi tiết quiz</h5>

            <!-- Accordion START -->
            <div class="accordion accordion-icon accordion-bg-light" id="accordionExample2">
                <div id="collapse-1" class="accordion-collapse collapse show" aria-labelledby="heading-1"
                    data-bs-parent="#accordionExample2">
                    <div class="accordion-body mt-3">
                        <div class="vstack gap-3">
                            <!-- Course lecture -->
                            <div>
                                @forelse ($quizResult->quiz_result_details as $quiz_result_detail)
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <div class="position-relative d-flex align-items-center">
                                            <a href="#"
                                                class="btn btn-success btn-round btn-sm mb-0 stretched-link position-static">
                                                <i class="bi bi-question-diamond fs-5"></i>
                                            </a>
                                            <span
                                                class="d-inline-block text-truncate ms-2 mb-0 h6 fw-light w-150px w-sm-200px">{{\App\Models\Question::where('id',$quiz_result_detail->question_id)->first()->title}}</span>
                                        </div>
                                        <p class="mb-0 text-truncate">{{\App\Models\Answer::where('id',$quiz_result_detail->answer_id)->first()->is_correct == 1 ? "đúng":"sai" }}</p>
                                    </div>
                                    <hr class="mb-0">
                                @empty
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Accordion END -->
        </div>
    </main>


@endsection

@section('custom-js-tag')
@endsection
@push('add-script')
@endpush
