@extends('layouts.frontend.auth')

@section('title', 'Đăng Nhập')

@section('content')
<section class="p-0 d-flex align-items-center position-relative overflow-hidden">
	
    <div class="container-fluid">
        <div class="row">
            <!-- left -->
            <div class="col-12 col-lg-6 d-md-flex align-items-center justify-content-center bg-primary bg-opacity-10 vh-lg-100">
                <div class="p-3 p-lg-5">
                    <!-- Title -->
                    <!-- SVG Image -->
                    <img src="/frontend/images/element/02.svg" class="mt-5" alt="">
                </div>
            </div>

            <!-- Right -->
            <div class="col-12 col-lg-6 m-auto">
                <div class="row my-5">
                    <div class="col-sm-10 col-xl-8 m-auto">
                        <!-- Title -->
                        <img src="/frontend/images/element/03.svg" class="h-40px mb-2" alt="">
                        <h2>Đăng ký tài khoản!</h2>
                        <!-- Form START -->
                        <form action="{{route('auth.processRegister')}}" method="POST" enctype="multipart/form-data">
                            @csrf 
                            @method('POST')
                            <!-- Email -->
                            <div class="mb-4">
                                <label for="exampleInputEmail1" class="form-label">Họ và tên *</label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text bg-light rounded-start border-0 text-secondary px-3"><i class="bi bi-envelope-fill"></i></span>
                                    <input type="text" name="name" value="{{old('name')}}" class="form-control border-0 bg-light rounded-end ps-1" placeholder="Nhập họ tên" >
                                </div>
                                @error('name')
                                    <div id="emailHelp" style="color: red" class="form-text">{{$message}}</div>
                                @enderror
                            </div>
                            <!-- Email -->
                            <div class="mb-4">
                                <label for="exampleInputEmail1" class="form-label">Email *</label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text bg-light rounded-start border-0 text-secondary px-3"><i class="bi bi-envelope-fill"></i></span>
                                    <input type="email" name="email" value="{{old('email')}}" class="form-control border-0 bg-light rounded-end ps-1" placeholder="Nhập địa chỉ email" id="exampleInputEmail1">
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
                                    <input type="password" name="password" class="form-control border-0 bg-light rounded-end ps-1" placeholder="Nhập mật khẩu" id="inputPassword5">
                                </div>
                                @error('password')
                                    <div id="emailHelp" style="color: red" class="form-text">{{$message}}</div>
                                @enderror
                            </div>
                            <!-- Confirm Password -->
                            <div class="mb-4">
                                <label for="inputPassword6" class="form-label">Xác nhận mật khẩu *</label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text bg-light rounded-start border-0 text-secondary px-3"><i class="fas fa-lock"></i></span>
                                    <input type="password" name="password_confirm" class="form-control border-0 bg-light rounded-end ps-1" placeholder="Nhập lại mật khẩu" id="inputPassword6">
                                </div>
                                @error('password_confirm')
                                    <div id="emailHelp" style="color: red" class="form-text">{{$message}}</div>
                                @enderror
                            </div>
                            <!-- -->
                            <div class="mb-4">
                                <label for="inputPassword6" class="form-label">Ảnh đại diện *</label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text bg-light rounded-start border-0 text-secondary px-3"><i class="fas fa-lock"></i></span>
                                    <input type="file" name="avatar" class="form-control border-0 bg-light rounded-end ps-1" placeholder="*********" id="inputPassword6">
                                </div>
                                @error('avatar')
                                    <div id="emailHelp" style="color: red" class="form-text">{{$message}}</div>
                                @enderror
                            </div>
                            <!-- Check box -->
                            <div class="mb-4">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="checkbox-1">
                                    <label class="form-check-label" for="checkbox-1">Khi đăng ký, bạn chấp nhận<a href="#"> điều khoản</a></label>
                                </div>
                            </div>
                            <!-- Button -->
                            <div class="align-items-center mt-0">
                                <div class="d-grid">
                                    <button class="btn btn-primary mb-0" type="submit">Đăng ký</button>
                                </div>
                            </div>
                        </form>
                        <!-- Form END -->

                        <!-- Social buttons -->
                        {{-- <div class="row">
                            <!-- Divider with text -->
                            <div class="position-relative my-4">
                                <hr>
                                <p class="small position-absolute top-50 start-50 translate-middle bg-body px-5">Or</p>
                            </div>
                            <!-- Social btn -->
                            <div class="col-xxl-6 d-grid">
                                <a href="#" class="btn bg-google mb-2 mb-xxl-0"><i class="fab fa-fw fa-google text-white me-2"></i>Signup with Google</a>
                            </div>
                            <!-- Social btn -->
                            <div class="col-xxl-6 d-grid">
                                <a href="#" class="btn bg-facebook mb-0"><i class="fab fa-fw fa-facebook-f me-2"></i>Signup with Facebook</a>
                            </div>
                        </div> --}}

                        <!-- Sign up link -->
                        <div class="mt-4 text-center">
                            <span>Bạn đã có tài khoản?<a href="{{route('auth.login')}}"> Đăng nhập ngay</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection