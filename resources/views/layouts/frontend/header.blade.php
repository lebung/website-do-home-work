<!-- Header START -->
<header class="navbar-light navbar-sticky header-static">
	<!-- Logo Nav START -->
	<nav class="navbar navbar-expand-xl">
		<div class="container-fluid px-3 px-xl-5">
			<!-- Logo START -->
			<a class="navbar-brand" href="{{ route('frontend.home') }}">
				<img class="light-mode-item navbar-brand-item" src="/frontend/images/logo.svg" alt="logo">
				<img class="dark-mode-item navbar-brand-item" src="/frontend/images/logo-light.svg" alt="logo">
			</a>
			<!-- Logo END -->

			<!-- Responsive navbar toggler -->
			<button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-animation">
					<span></span>
					<span></span>
					<span></span>
				</span>
			</button>

			<!-- Main navbar START -->
			<div class="navbar-collapse w-100 collapse" id="navbarCollapse">

				<!-- Nav Main menu START -->
				<ul class="navbar-nav navbar-nav-scroll me-auto">
					<!-- Nav item 1 Demos -->
					<li class="nav-item">
						<a class="nav-link" href="{{ route('frontend.home') }}"><i class="fas fa-home"></i> Trang chủ</a>
					</li>

					<li class="nav-item">
						<a class="nav-link" href="{{ route('course-list') }}"><i class="fas fa-list"></i> Khóa học</a>
					</li>

					<li class="nav-item dropdown dropdown-notifications">
						<a class="nav-link" href="#" id="advanceMenu" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fa-solid fa-bell"></i> <span class="amount-notifi">1</span>						</a>
						<ul class="dropdown-menu dropdown-menu-end min-w-auto menu-notify" data-bs-popper="none">
							<li> 
								<a class="dropdown-item" href="https://support.webestica.com/" target="_blank">
									<i class="text-warning fa-fw bi bi-life-preserver me-2"></i>Support
								</a> 
							</li>
							
						</ul>
					</li>

				</ul>
				<!-- Nav Main menu END -->

				<!-- Nav Search START -->
				<div class="nav my-3 my-xl-0 px-4 flex-nowrap align-items-center">
					<div class="nav-item w-100">
						<form class="position-relative" action="{{route('course-list')}}">
							<input class="form-control pe-5 bg-transparent" name="q" type="search" placeholder="Tìm kiếm..." aria-label="Search">
							<button class="bg-transparent p-2 position-absolute top-50 end-0 translate-middle-y border-0 text-primary-hover text-reset" type="submit">
								<i class="fas fa-search fs-6 "></i>
							</button>
						</form>
					</div>
				</div>
				<!-- Nav Search END -->
			</div>
			<!-- Main navbar END -->

			<!-- Profile START -->
			<div class="dropdown ms-1 ms-lg-0">
				<a class="avatar avatar-sm p-0" href="#" id="profileDropdown" role="button" data-bs-auto-close="outside" data-bs-display="static" data-bs-toggle="dropdown" aria-expanded="false">
					<img class="avatar-img rounded-circle" src="/frontend/images/avatar/01.jpg" alt="avatar">
				</a>
				<ul class="dropdown-menu dropdown-animation dropdown-menu-end shadow pt-3" aria-labelledby="profileDropdown">
					<!-- Profile info -->
					<li class="px-3 mb-3">
						<div class="d-flex align-items-center">
							<!-- Avatar -->
							<div class="avatar me-3">
								<img class="avatar-img rounded-circle shadow" src="/frontend/images/avatar/01.jpg" alt="avatar">
							</div>
							<div>
								<a class="h6" href="#">{{ auth()->user()->name }}</a>
								<p class="small m-0">{{ auth()->user()->email }}</p>
							</div>
						</div>
					</li>
					<li> <hr class="dropdown-divider"></li>
					<!-- Links -->
					@if (Auth::check() && Auth::user()->hasRole(['admin','teacher','manager']))
						<li><a class="dropdown-item" href="{{route('admin')}}"><i class="bi bi-person fa-fw me-2"></i>Trang quản trị</a></li>
					@endif
					
					{{-- <li><a class="dropdown-item" href="#"><i class="bi bi-person fa-fw me-2"></i>Edit Profile</a></li>
					<li><a class="dropdown-item" href="#"><i class="bi bi-gear fa-fw me-2"></i>Account Settings</a></li>
					<li><a class="dropdown-item" href="#"><i class="bi bi-info-circle fa-fw me-2"></i>Help</a></li> --}}
					<li><a class="dropdown-item bg-danger-soft-hover" href="{{route('auth.logout')}}"><i class="bi bi-power fa-fw me-2"></i>Đăng xuất</a></li>

					<li> <hr class="dropdown-divider"></li>
					<!-- Dark mode switch START -->
					<li>
						<div class="modeswitch-wrap" id="darkModeSwitch">
							<div class="modeswitch-item">
								<div class="modeswitch-icon"></div>
							</div>
							<span>Chế độ tối</span>
						</div>
					</li> 
					<!-- Dark mode switch END -->
				</ul>
			</div>
			<!-- Profile START -->
		</div>
	</nav>
	<!-- Logo Nav END -->
</header>
<!-- Header END -->