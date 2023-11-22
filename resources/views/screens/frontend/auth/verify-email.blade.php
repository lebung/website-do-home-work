@extends('layouts.frontend.auth')

@section('title', 'Đăng Nhập')

@section('content')
<section class="p-0 d-flex align-items-center position-relative overflow-hidden">
	
    <div class="container-fluid">
        <div class="row">
            <!-- left -->
            <div class="col-12 col-lg-6 d-md-flex align-items-center justify-content-center bg-primary bg-opacity-10 vh-lg-100">
                <div class="p-3 p-lg-5">
                    <!-- SVG Image -->
                    <img src="/frontend/images/element/02.svg" class="mt-5" alt="">
                </div>
            </div>
            <!-- Right -->
            <div class="col-12 col-lg-6 d-flex justify-content-center">
                <div class="row my-5">
                    <div class="col-sm-10 col-xl-12 m-auto">

          <!-- Title -->
                        <span class="mb-0 fs-1">🤔</span>
                        <h1 class="fs-2">Gửi lại email</h1>
                        <h5 class="fw-light mb-4">Nếu bạn chưa nhận được email hãy thử gửi lại</h5>
                        <h5 class="fw-light mb-4">Bạn phải xác minh email mới được đi tiếp</h5>
                        
                        <!-- Form START -->
                        <form action="{{ route('verification.send') }}" method="POST">
                            @csrf
                            @method('POST')
                            <!-- Button -->
                            <div class="align-items-center">
                                <div class="d-grid">
                                    <button class="btn btn-primary mb-0" type="submit">Gửi lại email xác thực</button>
                                </div>
                            </div>	
                        </form>
                        <!-- Form END -->
                    </div>
                    <div style="width: 150px;">
                        <a class="dropdown-item bg-danger-soft-hover" href="{{route('auth.logout')}}"><i class="bi bi-power fa-fw me-2"></i>Đăng xuất</a>
                    </div>
                    
                </div> <!-- Row END -->
            </div>
        </div> <!-- Row END -->
    </div>
</section>
@endsection


{{-- <div>
    <div>
        <div name="logo">
            
        </div>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <button>
                        Resend Verification Email
                    </button>
                </div>
            </form>

            <form method="POST" action="">
                @csrf

                <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
                    {{ __('Log out') }}
                </button>
            </form>
        </div>
    </div>
</div> --}}
