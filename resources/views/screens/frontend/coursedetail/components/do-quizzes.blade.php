<!-- Course item START -->
<div class="card border">

    <div class="card-header border-bottom">
        <!-- Course list START -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="row g-0">
                        <div class="col-md-10">
                            <div class="card-body">
                                <!-- Title -->
                                <h3 class="card-title"><a href="#">Name quiz: {{ $quiz->title }}</a></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Course list END -->
    </div>

    <div class="card-body">
        <!-- Step content START -->
        <div class="card bg-transparent border rounded-3 mb-1">
            <div id="stepper" class="bs-stepper stepper-outline">
                <!-- Card header -->
                <div class="card-header bg-light border-bottom px-lg-5">
                    <!-- Step Buttons START -->
                    <div class="bs-stepper-header row" role="tablist">
                        @forelse ($quiz->questions as $key => $question)
                            <div class="step col-3" data-target="#step-{{ $question->id }}">
                                <div class="d-grid text-center align-items-center">
                                    <button type="button" class="btn btn-link step-trigger mb-0" role="tab"
                                        id="steppertrigger{{ $question->id }}" aria-controls="step-{{ $question->id }}">
                                        <span class="bs-stepper-circle">{{ $key + 1 }}</span>
                                    </button>
                                </div>
                            </div>
                        @empty
                        @endforelse
                    </div>
                    <!-- Step Buttons END -->
                </div>

                <!-- Card body START -->
                <div class="card-body">

                    <div class="d-flex d-flex justify-content-between align-items-center">
                        <div class="d-flex justify-content-center mt-3">
                            <button type="button" onclick="score()" class="btn btn-success mb-0">Gửi kết quả</button>
                        </div>
                        <h6 class="text-danger text-end mb-0"><i class="bi bi-clock-history me-2"></i>Time Left:
                            <span id="time-left"> {{ $quiz->duration }}</span>
                        </h6>
                    </div>

                    <!-- Step content START -->
                    <div class="bs-stepper-content">

                        <form id="form-score" method="POST">
                            @csrf
                            <input type="text" value="{{ $quiz->id }}" name="quiz_id" hidden>
                            @forelse ($quiz->questions as $question)
                                <div id="step-{{ $question->id }}" role="tabpanel" class="content fade"
                                    aria-labelledby="steppertrigger{{ $question->id }}">

                                    <input type="text" value="{{ $question->id }}" name="question_id[]" hidden>
                                    <!-- Title -->
                                    <h4>Tiêu đề: {{ $question->title }}</h4>
                                    @if ($question->attachment)
                                        <img src="{{ asset("images/question/".$question->attachment) }}"
                                            class="rounded-2" alt="Card image" style="max-height: 300px">
                                    @endif
                                    <hr> <!-- Divider -->
                                    <div class="vstack">
                                        <!-- Feed ques item -->
                                        <div class="form-group  d-flex flex-column">
                                            @switch($question->type)
                                                @case(2)
                                                    @forelse ($question->answers as $answer)
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2"
                                                                name="answer_id[{{ $question->id }}][]"
                                                                value="{{ $answer->id }}">
                                                            <label class="form-check-label" for="inlineCheckbox2">
                                                                {{ $answer->content }} / {{ $answer->is_correct }}</label>

                                                        </div>
                                                    @empty
                                                    @endforelse
                                                @break

                                                @case(3)
                                                    @forelse ($question->answers as $answer)
                                                        <input type="text" value="{{ $answer->id }}"
                                                            name="answer_id[{{ $question->id }}][]" hidden>
                                                        <textarea id="editor{{ $answer->id }}" name="content_answer_essay[]"></textarea>
                                                        {{ $answer->is_correct }}
                                                    @empty
                                                    @endforelse
                                                @break

                                                @default
                                                    @forelse ($question->answers as $answer)
                                                        <div class="form-check">
                                                            <input class="form-check-input"
                                                                name="answer_id[{{ $question->id }}][]" type="radio"
                                                                name="flexRadioDefault" id="flexRadioDefault1"
                                                                value="{{ $answer->id }}">
                                                            <label class="form-check-label" for="flexRadioDefault1">
                                                                {{ $answer->content }} / {{ $answer->is_correct }}
                                                            </label>
                                                        </div>
                                                    @empty
                                                    @endforelse
                                                @break
                                            @endswitch
                                        </div>

                                        <div class="d-flex justify-content-center mt-3">
                                            <button type="button" class="btn btn-primary next-btn mb-0">Next
                                                question</button>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                @endforelse
                            </form>

                        </div>
                    </div>

                    <!-- Card body END -->
                </div>
            </div>
        </div>

    </div>
    <!-- Course item END -->
