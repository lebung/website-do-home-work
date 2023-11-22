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
                    <!-- Info -->
                </div>
            </div>
            <!-- Right -->
            <div class="col-12 col-lg-6 d-flex justify-content-center">
                <div class="row my-5">
                    <div class="col-sm-10 col-xl-12 m-auto">

          <!-- Title -->
                        <span class="mb-0 fs-1">🤔</span>
                        <h1 class="fs-2">Quên mật khẩu</h1>                        
                        <!-- Form START -->
                        <form action="" method="POST">
                            @csrf
                            @method('POST')
                            <!-- Email -->
                            <div class="mb-4">
                                <label for="exampleInputEmail1" class="form-label">Nhập địa chỉ email *</label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text bg-light rounded-start border-0 text-secondary px-3"><i class="bi bi-envelope-fill"></i></span>
                                    <input type="email" name="email" class="form-control border-0 bg-light rounded-end ps-1" placeholder="E-mail" id="exampleInputEmail1">
                                </div>
                                @error('email')
                                    <div id="emailHelp" style="color: red" class="form-text">{{$message}}</div>
                                @enderror
                            </div>
                            <!-- Button -->
                            <div class="align-items-center">
                                <div class="d-grid">
                                    <button class="btn btn-primary mb-0" type="submit">Khôi phục mật khẩu</button>
                                </div>
                            </div>	
                        </form>
                        <!-- Form END -->
                    </div>
                </div> <!-- Row END -->
            </div>
        </div> <!-- Row END -->
    </div>
</section>
@endsection