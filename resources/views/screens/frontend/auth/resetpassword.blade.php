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
                    <!-- Info -->
                </div>
            </div>

            <!-- Right -->
            <div class="col-12 col-lg-6 m-auto">
                <div class="row my-5">
                    <div class="col-sm-10 col-xl-8 m-auto">
                        <!-- Title -->
                        <span class="mb-0 fs-1">👋</span>
                        <h1 class="fs-2">Khôi phục mật khẩu</h1>
                        @if (session('message'))
                            <div class="alert alert-danger" style="color: red">
                                {{ session('message') }}
                            </div>
                        @endif
                        <!-- Form START -->
                        <form action="{{route('reset-password.process-password', [request('userId'), request('token')])}}" method="POST">
                            @csrf
                            @method('POST')
                            <!-- Email -->
                            <!-- Password -->
                            <div class="mb-4">
                                <label for="inputPassword5" class="form-label">Mật khẩu *</label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text bg-light rounded-start border-0 text-secondary px-3"><i class="fas fa-lock"></i></span>
                                    <input type="password" name="password" class="form-control border-0 bg-light rounded-end ps-1" placeholder="Mật khẩu" id="inputPassword5">
                                </div>
                                <div id="passwordHelpBlock" class="form-text">
                                    Mật khẩu tối thiểu 6 ký tự
                                </div>
                                @error('password')
                                    <div id="emailHelp" style="color: red" class="form-text">{{$message}}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="inputPassword5" class="form-label">Nhập lại mật khẩu *</label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text bg-light rounded-start border-0 text-secondary px-3"><i class="fas fa-lock"></i></span>
                                    <input type="password" name="password_confirm" class="form-control border-0 bg-light rounded-end ps-1" placeholder="Nhập lại mật khẩu" id="inputPassword5">
                                </div>
                                @error('password')
                                    <div id="emailHelp" style="color: red" class="form-text">{{$message}}</div>
                                @enderror
                            </div>

                            <!-- Button -->
                            <div class="align-items-center mt-0">
                                <div class="d-grid">
                                    <button class="btn btn-primary mb-0" type="submit">Khôi phục mật khẩu</button>
                                </div>
                            </div>
                        </form>
                        <!-- Form END -->


                        <!-- Sign up link -->
                        {{-- <div class="mt-4 text-center">
                            <span>Don't have an account? <a href="sign-up.html">Signup here</a></span>
                        </div> --}}
                    </div>
                </div> <!-- Row END -->
            </div>
        </div> <!-- Row END -->
    </div>
</section>
@endsection