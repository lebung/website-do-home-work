@extends('layouts.frontend.master')

@section('title', 'Lớp Học')

@section('content')
<!-- =======================
Page content START -->
<section class="pt-0">
	<div class="container">

		<div class="row mt-3">
			<!-- Main content START -->
			<div class="col-12">

                <div class="card card-class__detail shadow h-100">
                    <!-- Image -->
                    <img src="/frontend/images/courses/4by3/08.jpg" style="aspect-ratio:3.5/1;object-fit: cover;" class="card-img-top" alt="course image">
                    <div class="card-class__name">
						<p>{{ $classroom->name }}</p>
					</div>
					<div class="card-img-overlay d-flex align-items-start flex-column">
						<!-- Card overlay bottom -->
						<div class="w-100 mt-auto d-inline-flex">
							<div class="d-flex align-items-center bg-white p-2 rounded-2">
								<!-- Avatar -->
								<div class="avatar avatar-sm me-2">
									<img class="avatar-img rounded-1" src="{{ getPathImage($classroom->author->avatar) }}" alt="avatar">
								</div>
								<!-- Avatar info -->
								<div>
									<h6 class="mb-0"><a class="text-dark">{{ $classroom->author->name }}</a></h6>
								</div>
							</div>
						</div>
					</div>
                </div>

			</div>
			<!-- Main content END -->
		</div><!-- Row END -->
	</div>
</section>
<!-- =======================
Page content END -->

<section class="pt-0">
	<div class="container">

		<div class="row mt-3">
			<!-- Main content START -->
			<div class="col-12">

				<!-- Course Grid START -->
				<div class="row g-4">

					@foreach ($classroom->courses as $course)
					<!-- Course item -->
					<div class="col-sm-6 col-lg-4 col-xl-3">
						<!-- Image -->
						<div class="card card-metro overflow-hidden rounded-3">
							<img src="{{ getPathImage($course->thumbnail) }}" alt="">
							<!-- Image overlay -->
							<div class="card-img-overlay d-flex"> 
								<!-- Info -->
								<div class="mt-auto card-text">
									<a href="{{ route('course-learn', ['id' => $course->id, 'slug' => $course->slug]) }}" class="text-white mt-auto h5 stretched-link">{{ $course->title }}</a>
									<div class="text-white">{{ $course->lessons->count() }} bài học</div>
								</div>
							</div>
						</div>
						<div class="progress progress-sm bg-primary bg-opacity-10">
							<div class="progress-bar bg-primary" role="progressbar" style="width: {{ $course->getProgress() }}%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">
								<span class="progress-percent-simple ms-auto">{{ $course->getProgress() }}%</span>
							</div>
						</div>
					</div>
					@endforeach

				</div>
				<!-- Course Grid END -->
			</div>
			<!-- Main content END -->
		</div><!-- Row END -->
	</div>
</section>

@endsection