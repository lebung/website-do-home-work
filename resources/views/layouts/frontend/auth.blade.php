<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from eduport.webestica.com/sign-in.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 30 Aug 2022 16:33:22 GMT -->
<head>
	<title>@yield('title')</title>

	<!-- Meta Tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="author" content="Webestica.com">
	<meta name="description" content="Eduport- LMS, Education and Course Theme">

	<!-- Favicon -->
	<link rel="shortcut icon" href="/frontend/images/favicon.ico">

	<!-- Google Font -->
	<link rel="preconnect" href="https://fonts.googleapis.com/">
	<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;700&amp;family=Roboto:wght@400;500;700&amp;display=swap">

	<!-- Plugins CSS -->
	<link rel="stylesheet" type="text/css" href="/frontend/vendor/font-awesome/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="/frontend/vendor/bootstrap-icons/bootstrap-icons.css">

	<!-- Theme CSS -->
	<link id="style-switch" rel="stylesheet" type="text/css" href="/frontend/css/style.css">

</head>

<body>

<!-- **************** MAIN CONTENT START **************** -->
<main>
	@yield('content')
</main>
<!-- **************** MAIN CONTENT END **************** -->

<!-- Back to top -->
<div class="back-top"><i class="bi bi-arrow-up-short position-absolute top-50 start-50 translate-middle"></i></div>

<!-- Bootstrap JS -->
<script src="/frontend/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

<!-- Template Functions -->
<script src="/frontend/js/functions.js"></script>
@yield('custom-js-tag')
@stack('add-script')
</body>

<!-- Mirrored from eduport.webestica.com/sign-in.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 30 Aug 2022 16:33:22 GMT -->
</html>