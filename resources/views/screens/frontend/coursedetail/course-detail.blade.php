@extends('layouts.frontend.master')

@section('title', 'Lớp Học')

@section('plugin-css')
    <link rel="stylesheet" type="text/css" href="/frontend/vendor/choices/css/choices.min.css">
    <link rel="stylesheet" type="text/css" href="/frontend/vendor/aos/aos.css">
    <link rel="stylesheet" type="text/css" href="/frontend/vendor/plyr/plyr.css" />
    <link rel="stylesheet" type="text/css" href="/frontend/vendor/stepper/css/bs-stepper.min.css">'
    <script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>'
@endsection

@section('custom-css')
    <style>
        .form-select {
            overflow: hidden;
        }
    </style>
@endsection

@section('content')

    <main>

        <section class="pt-0">
            <div class="container">
                <a class="btn btn-primary" href="{{url()->previous()}}">
                    quay lại << 
                </a>
                @include('screens.frontend.coursedetail.components.do-quizzes')

            </div>
        </section>
    </main>



@endsection

@section('custom-js-tag')
    {{-- cdn --}}
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Vendors -->
    <script src="/frontend/vendor/aos/aos.js"></script>
    <script src="/frontend/vendor/plyr/plyr.js"></script>
    <!-- Vendors -->
    <script src="/frontend/vendor/stepper/js/bs-stepper.min.js"></script>
@endsection

@push('add-script')
    <script>
        function score() {
            Swal.fire({
                title: 'Bạn muốn gửi kết quả ngay bây giờ?',
                text: "Bạn gửi xong sẽ không được làm lại!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Đúng tôi muốn gửi'
            }).then((result) => {
                post_score()
            })
        }


        const startMinutes = '{{ $quiz->duration }}'
        let time = startMinutes * 60
        const t = setInterval(() => {
            const minutes = Math.floor(time / 60)
            const seconds = time % 60
            const result = `${parseInt(minutes)}:${parseInt(seconds)}`
            document.getElementById('time-left').innerHTML = result
            time--
            if (minutes === 0 && seconds === 0) {
                clearInterval(t)
                post_score()
            }
        }, 1000)


        function post_score() {
            const formData = new FormData(document.querySelector('#form-score'));
            axios.post('{{ route('frontend.doquiz') }}', formData)
                .then(res =>
                    Swal.fire(
                        'Bạn đã gửi đáp án!',
                        'Chọn đễ chuyển sang trang kết quả nhận được!',
                        'success'
                    )
                    .then(val => {
                        let _url = "{{ route('frontend.result', ['quiz_id' => ':quiz_id']) }}"
                        console.log(res);
                        _url = _url.replace(":quiz_id", res.data)
                        window.location.assign(_url)
                    })
                )
                .catch(res => console.log(res))
        }
    </script>
@endpush
