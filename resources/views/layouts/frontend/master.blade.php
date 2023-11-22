<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from eduport.webestica.com/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 30 Aug 2022 16:30:50 GMT -->
<head>
	<title>@yield('title')</title>

	<!-- Meta Tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="author" content="Webestica.com">
	<meta name="description" content="Eduport- LMS, Education and Course Theme">

	<!-- Favicon -->
	<link rel="shortcut icon" href="/frontend/images/favicon.ico">
	<meta name="csrf-token" content="{{ csrf_token() }}"/>
	<!-- Google Font -->
	<link rel="preconnect" href="https://fonts.googleapis.com/">
	<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;700&amp;family=Roboto:wght@400;500;700&amp;display=swap">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
	<!-- Plugins CSS -->
	<link rel="stylesheet" type="text/css" href="/frontend/vendor/font-awesome/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="/frontend/vendor/bootstrap-icons/bootstrap-icons.css">
	<link rel="stylesheet" type="text/css" href="/frontend/vendor/tiny-slider/tiny-slider.css">
	<link rel="stylesheet" type="text/css" href="/frontend/vendor/glightbox/css/glightbox.css">
	@yield('plugin-css')
	<link rel="stylesheet" href="https://cdn.plyr.io/3.7.2/plyr.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.29/sweetalert2.css" integrity="sha512-e+TwvhjDvKqpzQLJ7zmtqqz+5jF9uIOa+5s1cishBRfmapg7mqcEzEl44ufb04BXOsEbccjHK9V0IVukORmO8w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<!-- Theme CSS -->
	<link id="style-switch" rel="stylesheet" type="text/css" href="/frontend/css/style.css">
	<link id="style-switch" rel="stylesheet" type="text/css" href="/frontend/css/custom.css">
	@yield('custom-css')
</head>

<body><!-- Pre loader -->
    {{-- <div class="preloader">
        <div class="preloader-item">
            <div class="spinner-grow text-primary"></div>
        </div>
    </div> --}}
@include('layouts.frontend.header')

<!-- **************** MAIN CONTENT START **************** -->
<main>
	
@yield('content')

</main>
<!-- **************** MAIN CONTENT END **************** -->

@include('layouts.frontend.footer')

<!-- Back to top -->
<div class="back-top"><i class="bi bi-arrow-up-short position-absolute top-50 start-50 translate-middle"></i></div>

<!-- Bootstrap JS -->
<script src="/frontend/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<!-- Vendors -->
<script src="/frontend/vendor/tiny-slider/tiny-slider.js"></script>
<script src="/frontend/vendor/glightbox/js/glightbox.js"></script>
<script src="/frontend/vendor/purecounterjs/dist/purecounter_vanilla.js"></script>

@yield('custom-js-tag')

<!-- Template Functions -->

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
<script src="/frontend/js/functions.js"></script>
<script src="/frontend/js/notifications.js"></script>

<script src="https://cdn.plyr.io/3.7.2/plyr.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.29/sweetalert2.min.js" integrity="sha512-gCB2+0sWe4La5U90EqaPP2t58EczKkQE9UoCpnkG2EDSOOihgX/6MiT3MC4jYVEX03pv6Ydk1xybLG/AtN+3KQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
		}
	})
</script>

@if(session('status'))
<script>
    alert("Lỗi. Bạn không cso quyền truy cập trang này");
</script>
@endif

@yield('custom-js-tag')
@stack('add-script')

</body>

</html>