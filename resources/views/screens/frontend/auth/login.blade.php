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
            <div class="col-12 col-lg-6 m-auto">
                <div class="row my-5">
                    <div class="col-sm-10 col-xl-8 m-auto">
                        <!-- Title -->
                        <span class="mb-0 fs-1">👋</span>
                        <h1 class="fs-2">Đăng nhập!</h1>
                        @if (session('status'))
                            <div class="alert alert-success" >
                                {{ session('status') }}
                            </div>
                        @endif

                        @if (session('message'))
                            <div class="alert alert-danger" style="color: red">
                                {{ session('message') }}
                            </div>
                        @endif

                        @if($errors->any() && $retries > 0)
                            <div class="alert alert-danger" style="color: red">
                                Bạn còn {{$retries}} lần login
                            </div>
                        @endif
                        {{-- <div class="alert alert-danger" style="color: red">
                            Lỗi login thứ {{$retries}}
                        </div> --}}
                        @if( $retries <= 0)
                            <div class="alert alert-danger" style="color: red">
                                Bạn Login quá nhiều. Thử lại sau {{$secounds}}s
                            </div>
                        @endif

                        <!-- Form START -->
                        <form action="{{route('auth.processLogin')}}" method="POST">
                            @csrf
                            @method('POST')
                            <!-- Email -->
                            <div class="mb-4">
                                <label for="exampleInputEmail1" class="form-label">Địa chỉ email *</label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text bg-light rounded-start border-0 text-secondary px-3"><i class="bi bi-envelope-fill"></i></span>
                                    <input type="email" name="email" class="form-control border-0 bg-light rounded-end ps-1" placeholder="E-mail" id="exampleInputEmail1">
                                </div>
                                @error('email')
                                    <div id="emailHelp" style="color: red" class="form-text">{{$message}}</div>
                                @enderror
                            </div>
                            <!-- Password -->
                            <div class="mb-4">
                                <label for="inputPassword5" class="form-label">Mật khẩu *</label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text bg-light rounded-start border-0 text-secondary px-3"><i class="fas fa-lock"></i></span>
                                    <input type="password" name="password" class="form-control border-0 bg-light rounded-end ps-1" placeholder="Mật khẩu" id="inputPassword5">
                                </div>
                                @error('password')
                                    <div id="emailHelp" style="color: red" class="form-text">{{$message}}</div>
                                @enderror
                            </div>
                            <!-- Check box -->
                            <div class="mb-4 d-flex justify-content-between mb-4">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Nhớ mật khẩu</label>
                                </div>
                                <div class="text-primary-hover">
                                    <a href="{{route('forgotPassword.forgotPasswordForm')}}" class="text-secondary">
                                        <u>Quên mật khẩu?</u>
                                    </a>
                                </div>
                            </div>
                            <!-- Button -->
                            <div class="align-items-center mt-0">
                                <div class="d-grid">
                                    <button class="btn btn-primary mb-0" type="submit">Đăng nhập</button>
                                </div>
                            </div>
                        </form>
                        <!-- Form END -->

                        <!-- Social buttons and divider -->
                        {{-- <div class="row">
                            <!-- Divider with text -->
                            <div class="position-relative my-4">
                                <hr>
                                <p class="small position-absolute top-50 start-50 translate-middle bg-body px-5">Or</p>
                            </div>

                            <!-- Social btn -->
                            <div class="col-xxl-6 d-grid">
                                <a href="#" class="btn bg-google mb-2 mb-xxl-0"><i class="fab fa-fw fa-google text-white me-2"></i>Login with Google</a>
                            </div>
                            <!-- Social btn -->
                            <div class="col-xxl-6 d-grid">
                                <a href="#" class="btn bg-facebook mb-0"><i class="fab fa-fw fa-facebook-f me-2"></i>Login with Facebook</a>
                            </div>
                        </div> --}}

                        <!-- Sign up link -->
                        <div class="mt-4 text-center">
                            <span>Bạn chưa có tài khoản? <a href="{{route('auth.register')}}">Đăng ký ngay</a></span>
                        </div>
                    </div>
                </div> <!-- Row END -->
            </div>
        </div> <!-- Row END -->
    </div>
</section>
@endsection