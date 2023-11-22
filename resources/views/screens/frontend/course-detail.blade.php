@extends('layouts.frontend.master')

@section('title', $course->title)

@section('content')

<!-- =======================
Page content START -->
<section class="pb-0 py-lg-5">
	<div class="container">
		<div class="row">
			<!-- Main content START -->
			<div class="col-lg-8">
				<div class="card shadow rounded-2 p-0">
					<!-- Tabs START -->
					<div class="card-header border-bottom px-4 py-3">
						<ul class="nav nav-pills nav-tabs-line py-0" id="course-pills-tab" role="tablist">
							<!-- Tab item -->
							<li class="nav-item me-2 me-sm-4" role="presentation">
								<button class="nav-link mb-2 mb-md-0 active" id="course-pills-tab-1" data-bs-toggle="pill" data-bs-target="#course-pills-1" type="button" role="tab" aria-controls="course-pills-1" aria-selected="true">Nội dung</button>
							</li>
							<!-- Tab item -->
							<li class="nav-item me-2 me-sm-4" role="presentation">
								<button class="nav-link mb-2 mb-md-0" id="course-pills-tab-2" data-bs-toggle="pill" data-bs-target="#course-pills-2" type="button" role="tab" aria-controls="course-pills-2" aria-selected="false">Chương trình học</button>
							</li>
						</ul>
					</div>
					<!-- Tabs END -->

					<!-- Tab contents START -->
					<div class="card-body p-4">
						<div class="tab-content pt-2" id="course-pills-tabContent">
							<!-- Content START -->
							<div class="tab-pane fade show active" id="course-pills-1" role="tabpanel" aria-labelledby="course-pills-tab-1">
								{!! $course->content !!}
							</div>
							<!-- Content END -->

							<!-- Content START -->
							<div class="tab-pane fade" id="course-pills-2" role="tabpanel" aria-labelledby="course-pills-tab-2">
								<!-- Course accordion START -->
								<div class="accordion accordion-icon accordion-bg-light" id="accordionExample2">
									@foreach($course->sections as $key => $section)
									<!-- Item -->
									<div class="accordion-item mb-3">
										<h6 class="accordion-header font-base" id="heading-{{$key}}">
											<button class="accordion-button fw-bold collapsed rounded d-sm-flex d-inline-block" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{$key}}" aria-expanded="false" aria-controls="collapse-{{$key}}">
												{{ $section->title }}
												<span class="small ms-0 ms-sm-2">({{ $section->lessons->count() }} bài học)</span> 
											</button>
										</h6>
										<div id="collapse-{{$key}}" class="accordion-collapse collapse" aria-labelledby="heading-{{$key}}" data-bs-parent="#accordionExample2">
											<!-- Accordion body START -->
											<div class="accordion-body mt-3">
												@foreach($section->lessons as $lesson)
												<!-- Course lecture -->
												<div class="d-flex justify-content-between align-items-center">
													<div class="position-relative d-flex align-items-center">
														<a class="btn btn-danger-soft btn-round btn-sm mb-0 stretched-link position-static">
															{!! getIconLesson($lesson) !!}
														</a>
														<span class="d-inline-block text-truncate ms-2 mb-0 h6 fw-light w-100px w-sm-200px w-md-400px">{{ $lesson->title }}</span>
													</div>
												</div>
												<hr> <!-- Divider -->
												@endforeach
											</div>
											<!-- Accordion body END -->
										</div>
									</div>
									@endforeach
								</div>
								<!-- Course accordion END -->
							</div>
							<!-- Content END -->
						</div>
					</div>
					<!-- Tab contents END -->
				</div>
			</div>
			<!-- Main content END -->

			<!-- Right sidebar START -->
			<div class="col-lg-4 pt-5 pt-lg-0">
				<div class="row mb-5 mb-lg-0">
					<div class="col-md-6 col-lg-12">
						<!-- Video START -->
						<div class="card shadow p-2 mb-4 z-index-9">
							<div class="overflow-hidden rounded-3">
								<img src="{{ getPathImage($course->thumbnail) }}" class="card-img" alt="{{ $course->title }}">
								<!-- Overlay -->
								<div class="bg-overlay bg-dark opacity-6"></div>
								<div class="card-img-overlay d-flex align-items-start flex-column p-3">
									<!-- Video button and link -->
									<div class="m-auto">
										<a class="btn btn-lg text-danger btn-round btn-white-shadow mb-0">
											<i class="fas fa-play"></i>
										</a>
									</div>
								</div>
							</div>
		
							<!-- Card body -->
							<div class="card-body px-3">
								<!-- Info -->
								<div class="d-flex justify-content-between align-items-center">
									<!-- Price and time -->
									<div>
										<div class="d-flex align-items-center">
											<h3 class="fw-bold mb-0 me-2">{{ $course->title }}</h3>
										</div>
									</div>

								</div>

								<!-- Buttons -->
								<div class="mt-3 d-sm-flex justify-content-sm-between">
									@if (auth()->user()->courses->contains($course->id))
									<a href="{{ route('course-learn', ['id' => $course->id, 'slug' => $course->slug]) }}" class="btn btn-outline-primary mb-0">Tiếp tục học</a>
									@else
									<a href="{{ route('join-course-learn', ['id' => $course->id, 'slug' => $course->slug]) }}" class="btn btn-success mb-0">Tham gia khóa học</a>
									@endif
									
								</div>
							</div>
						</div>
						<!-- Video END -->

						<!-- Course info START -->
						<div class="card card-body shadow p-4 mb-4">
							<!-- Title -->
							<h4 class="mb-3">This course includes</h4>
							<ul class="list-group list-group-borderless">
								<li class="list-group-item d-flex justify-content-between align-items-center">
									<span class="h6 fw-light mb-0"><i class="fas fa-fw fa-book-open text-primary"></i>Bài học</span>
									<span>{{ $course->lessons->count() }}</span>
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-center">
									<span class="h6 fw-light mb-0"><i class="fas fa-fw fa-users text-primary"></i>Học viên</span>
									<span>{{ $course->users->count() }}</span>
								</li>
							</ul>
						</div>
						<!-- Course info END -->
					</div>

				</div><!-- Row End -->
			</div>
			<!-- Right sidebar END -->

		</div><!-- Row END -->
	</div>
</section>
<!-- =======================
Page content END -->
@endsection