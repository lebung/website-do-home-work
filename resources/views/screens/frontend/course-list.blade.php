@extends('layouts.frontend.master')

@section('title', 'Danh Sách Khóa Học')

@section('content')
<!-- =======================
Page Banner START -->
<section class="py-4">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="bg-light p-4 text-center rounded-3">
					<h1 class="m-0">Danh Sách Khóa Học</h1>
					<!-- Breadcrumb -->
					<div class="d-flex justify-content-center">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb breadcrumb-dots mb-0">
								<li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
								<li class="breadcrumb-item active" aria-current="page">Danh sách khóa học</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- =======================
Page Banner END -->


<!-- =======================
Page content START -->
<section class="pt-0">
	<div class="container">
	<!-- Filter bar START -->
	<form class="bg-light border p-4 rounded-3 my-4 z-index-9 position-relative">
		<div class="row g-3">
			<!-- Input -->
			<div class="col-xl-6">
				<input class="form-control me-1" value="{{ request()->query('q') ?? '' }}" type="search" name="q" placeholder="Nhập tên khóa học...">
			</div>

			<!-- Select item -->
			<div class="col-xl-5">
				<div class="row g-3">
					<!-- Select items -->
					<div class="col-sm-12 col-md-12 pb-2 pb-md-0">
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
				</div> <!-- Row END -->
			</div>
			<!-- Button -->
			<div class="col-xl-1">
				<button type="submit" class="btn btn-primary mb-0 rounded z-index-1 w-100"><i class="fas fa-search"></i></button>
			</div>
		</div> <!-- Row END -->
	</form>
	<!-- Filter bar END -->
		<div class="row mt-3">
			<!-- Main content START -->
			<div class="col-12">

				<!-- Course Grid START -->
				<div class="row g-4">
					@foreach($courses as $course)
					<!-- Card item START -->
					<div class="col-sm-6 col-lg-4 col-xl-3">
						<div class="card p-2">
							<div class="position-relative" style="aspect-ratio: 1.5/1">
								<img src="{{ getPathImage($course->thumbnail) }}" style="width: 100%;height:100%;object-fit:cover" class="card-img rounded-2" alt="{{ $course->title }}">
								<div class="card-img-overlay">
									<div class="position-absolute top-50 start-50 translate-middle">
										<a href="{{ route('course-detail', ['id' => $course->id, 'slug' => $course->slug]) }}" class="btn btn-lg text-danger btn-round btn-white-shadow">
											<i class="fas fa-play"></i>
										</a>
									</div>
								</div>
							</div>
						
							<!-- Card body -->
							<div class="card-body">
								<!-- Title -->
								<h5><a href="{{ route('course-detail', ['id' => $course->id, 'slug' => $course->slug]) }}" class="stretched-link">{{ $course->title }}</a></h5>
							</div>
						</div>
					</div>
					<!-- Card item END -->
					@endforeach
				</div>
				<!-- Course Grid END -->

				<!-- Pagination START -->
				{{ $courses->withQueryString()->links('layouts.frontend.pagination') }}
				<!-- Pagination END -->
			</div>
			<!-- Main content END -->
		</div><!-- Row END -->
	</div>
</section>
<!-- =======================
Page content END -->
@endsection