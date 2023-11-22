@extends('layouts.frontend.master')

@section('title', $lesson->title . ' - ' . $course->title)

@section('content')
    <!-- =======================
                Page banner video START -->
    <section class="py-0 pb-lg-5">
        <div class="container">
            <div class="row g-3">
                <!-- Course video START -->
                <div class="col-12">
                    <div class="rounded-3" style="@if ($lesson->lesson_type != 'text' && !in_array(getExtensionPath($lesson->doc_file), ['docx', 'doc'])) aspect-ratio:2/1;overflow:hidden @endif">
                        @if ($lesson->lesson_type == 'video' && $lesson->video_type == 'system')
                            <video id="player" playsinline controls data-poster="/path/to/poster.jpg">
                                <source src="/{{ $lesson->video_path }}" type="video/mp4" />
                            </video>
                        @elseif ($lesson->lesson_type == 'video' && $lesson->video_type == 'youtube')
                            <div class="plyr__video-embed" id="player">
                                <iframe
                                    src="https://www.youtube.com/embed/{{ getYoutubeID($lesson->video_path) }}?origin=https://plyr.io&amp;iv_load_policy=3&amp;modestbranding=1&amp;playsinline=1&amp;showinfo=0&amp;rel=0&amp;enablejsapi=1"
                                    allowfullscreen allowtransparency allow="autoplay"></iframe>
                            </div>
                        @elseif ($lesson->lesson_type == 'document')
                            @if (!in_array(getExtensionPath($lesson->doc_file), ['docx', 'doc']))
                                <iframe src="{{ route('doc-viewer', $lesson->doc_file) }}"
                                    style="width: 100%;height: 100%;"></iframe>
                            @else
                                <iframe src="{{ route('doc-viewer', $lesson->doc_file) }}" hidden></iframe>
                            @endif
                        @endif
                    </div>
                </div>
                <!-- Course video END -->

                <!-- Playlist responsive toggler START -->
                <div class="col-12 d-lg-none">
                    <button class="btn btn-primary mb-3" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar">
                        <i class="bi bi-camera-video me-1"></i> Playlist
                    </button>
                </div>
                <!-- Playlist responsive toggler END -->
            </div>
        </div>
    </section>
    <!-- =======================
                Page banner video END -->

    <!-- =======================
                Page content START -->
    <section class="pt-0">
        <div class="container">
            <div class="row g-lg-5">

                <!-- Main content START -->
                <div class="col-lg-8">
                    <div class="row g-4">

                        <!-- Course title START -->
                        <div class="col-12">
                            <!-- Title -->
                            <h3 class="mb-3">{{ $lesson->title }} | {{ $course->title }}</h3>
                            <!-- Content -->
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item h6 me-3 mb-1 mb-sm-0"><i
                                        class="fas fa-user-graduate text-orange me-2"></i>{{ $course->users->count() }}
                                    người tham gia</li>
                            </ul>
                        </div>
                        <!-- Course title END -->

                        <!-- Course detail START -->
                        <div class="col-12">
                            <!-- Tabs START -->
                            <ul class="nav nav-pills nav-pills-bg-soft px-3" id="course-pills-tab" role="tablist">
                                <!-- Tab item -->
                                <li class="nav-item me-2 me-sm-4" role="presentation">
                                    <button class="nav-link mb-0 active" id="course-pills-tab-1" data-bs-toggle="pill"
                                        data-bs-target="#course-pills-1" type="button" role="tab"
                                        aria-controls="course-pills-1" aria-selected="true">Nội dung</button>
                                </li>
                                <!-- Tab item -->
                                <li class="nav-item me-2 me-sm-4" role="presentation">
                                    <button class="nav-link mb-0" id="course-pills-tab-2" data-bs-toggle="pill"
                                        data-bs-target="#course-pills-2" type="button" role="tab"
                                        aria-controls="course-pills-2" aria-selected="false">Tệp đính kèm</button>
                                </li>
                            </ul>
                            <!-- Tabs END -->

                            <!-- Tab contents START -->
                            <div class="tab-content pt-4 px-3" id="course-pills-tabContent">
                                <!-- Content START -->
                                <div class="tab-pane fade show active" id="course-pills-1" role="tabpanel"
                                    aria-labelledby="course-pills-tab-1">
                                    {!! $lesson->content !!}
                                </div>
                                <!-- Content END -->

                                <!-- Content START -->
                                <div class="tab-pane fade" id="course-pills-2" role="tabpanel"
                                    aria-labelledby="course-pills-tab-2">
                                    <ul class="list-group">
                                        @foreach (json_decode($lesson->attachment, false) as $key => $val)
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <p class="m-0">Tệp đính kèm {{ $key + 1 }}</p>
                                                <a href="{{ route('doc-viewer', $val) }}" target="_blank"
                                                    class="btn btn-link btn-success m-0"><i class="fas fa-download"></i></a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <!-- Content END -->

                            </div>
                            <!-- Tab contents END -->
                        </div>
                        <!-- Course detail END -->
                    </div>
                </div>
                <!-- Main content END -->

                <!-- Right sidebar START -->
                <div class="col-lg-4">
                    <!-- Responsive offcanvas body START -->
                    <div class="offcanvas-lg offcanvas-end" tabindex="-1" id="offcanvasSidebar"
                        aria-labelledby="offcanvasSidebarLabel">
                        <div class="offcanvas-header bg-dark">
                            <h5 class="offcanvas-title text-white" id="offcanvasSidebarLabel">Course playlist</h5>
                            <button type="button" class="btn btn-sm btn-light mb-0" data-bs-dismiss="offcanvas"
                                data-bs-target="#offcanvasSidebar" aria-label="Close"><i class="bi bi-x-lg"></i></button>
                        </div>
                        <div class="offcanvas-body p-3 p-lg-0">
                            <div class="col-12">
                                <!-- Accordion START -->
                                <div class="accordion accordion-icon accordion-bg-light" id="accordionExample2">
                                    @foreach ($course->sections as $key => $section)
                                        <!-- Item -->
                                        <div class="accordion-item mb-3">
                                            <h6 class="accordion-header font-base" id="heading-{{ $key }}">
                                                <a class="accordion-button fw-bold collapsed rounded d-block"
                                                    href="#collapse-{{ $key }}" data-bs-toggle="collapse"
                                                    data-bs-target="#collapse-{{ $key }}"
                                                    aria-expanded="{{ $section->lessons->contains($lesson->id) ? 'true' : 'false' }}"
                                                    aria-controls="collapse-{{ $key }}">
                                                    <span class="mb-0">{{ $section->title }}</span>
                                                    <span class="small d-block mt-1">({{ $section->lessons->count() }} bài
                                                        học)</span>
                                                </a>
                                            </h6>
                                            <div id="collapse-{{ $key }}"
                                                class="accordion-collapse collapse {{ $section->lessons->contains($lesson->id) ? 'show' : '' }}"
                                                aria-labelledby="heading-{{ $key }}"
                                                data-bs-parent="#accordionExample2">
                                                <!-- Accordion body START -->
                                                <div class="accordion-body mt-3">
                                                    <div class="vstack gap-3">
                                                        @foreach ($section->lessons as $key => $l)
                                                            <!-- Course lecture -->
                                                            <div
                                                                class="d-flex justify-content-between align-items-center {{ $lesson->id == $l->id ? 'bg-light' : '' }}">
                                                                <div class="position-relative d-flex align-items-center">
                                                                    <a href="{{ route('course-learn', ['id' => $course->id, 'slug' => $course->slug, 'lesson' => $l->id]) }}"
                                                                        class="btn btn-danger-soft btn-round btn-sm mb-0 stretched-link position-static">
                                                                        {!! getIconLesson($l) !!}
                                                                    </a>
                                                                    <span
                                                                        class="d-inline-block text-truncate ms-2 mb-0 h6 fw-light w-200px">{{ $l->title }}</span>
                                                                </div>
                                                                @if ($lessonHistories->contains('lesson_id', $l->id))
                                                                    <p class="m-0">
                                                                        <i class="fas fa-check"></i>
                                                                    </p>
                                                                @else
                                                                    <div class="form-check">
                                                                        <input class="form-check-input mark-lesson"
                                                                            data-course-id="{{ $course->id }}"
                                                                            type="checkbox" value="{{ $l->id }}">
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <div class="px-3">
                                                                @foreach ($l->quizs as $quiz)
                                                                    <div
                                                                        class="position-relative d-flex align-items-center border border-success p-1 rounded">
                                                                        <span
                                                                            class="d-inline-block text-truncate ms-2 mb-0 h6 fw-light w-200px">{{ $quiz->title }}</span>
                                                                        <a class="btn btn-success"
                                                                            style="margin-bottom:0px"
                                                                            href="{{ route('frontend.coursedetail', $quiz->id) }}">
                                                                            Làm bài
                                                                        </a>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <!-- Accordion body END -->
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <!-- Accordion END -->
                            </div>
                        </div>
                    </div>
                    <!-- Responsive offcanvas body END -->
                </div>
                <!-- Right sidebar END -->

            </div><!-- Row END -->
        </div>
    </section>
    <!-- =======================
                Page content END -->
@endsection

@push('add-script')
    <script>
        $(document).ready(function() {
            const player = new Plyr('#player');
            $('.mark-lesson').click(function() {
                let _url = '{{ route('mark-lesson', ':lesson') }}'
                _url = _url.replace(':lesson', $(this).val())
                let course = $(this).data('course-id')
                $this = $(this)
                Swal.fire({
                    text: "Bạn có muốn đánh dấu hoàn thành bài học này?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Đồng ý',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: _url,
                            type: 'POST',
                            data: {
                                course_id: course
                            },
                            dataType: 'json',
                            success: function(res) {
                                $this.prop('checked', true)
                                $this.prop('disabled', true)
                            }
                        })
                    }
                })
                return false
            })
        })
    </script>
@endpush
