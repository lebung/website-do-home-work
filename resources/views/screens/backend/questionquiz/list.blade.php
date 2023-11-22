@extends('layouts.backend.master')

@section('title', 'Trang Quản Trị')

@section('content')
    @include('screens.backend.questionquiz.components.layout.modalcreate')
    @include('screens.backend.questionquiz.components.layout.modalupdate')
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            @include('screens.backend.questionquiz.components.layout.nav')
        </div>

        <div class="card-body" id="table-main">
        
        </div>
    </div>
    <div id="bach">
    </div>
@endsection

@push('add-script')
    <script src="{{ asset('backend/js/pages/crud/forms/widgets/tagify.js') }}"></script>

    <script>
        function alert_error(message) {
            Swal.fire({
                icon: 'error',
                title: 'Mất kết nối',
                text: message + '!',
            })
        }

        function option_answer(myseft, type_question) {
            if (type_question == 1 || type_question == 0 || type_question == 4) {
                Array.from(document.querySelectorAll('.tools-answer select')).forEach(
                    (elm) => {
                        let listOption = Array.from(elm.querySelectorAll('option'))
                        listOption.forEach(elm1 => elm1.selected = true)
                    }
                )
                if (myseft) {
                    console.log(myseft, Array.from(myseft.querySelectorAll('option')));
                    let options = Array.from(myseft.querySelectorAll('option'))
                    if (myseft.value == 1) {
                        options[1].selected = true
                    } else {
                        options[0].selected = true
                    }
                }
            }
        }
        
    </script>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script src="{{ asset('js/question/create.js') }}"></script>
    <script src="{{ asset('js/question/update.js') }}"></script>

    @include('screens.backend.questionquiz.components.renders.filter')
    @include('screens.backend.questionquiz.components.renders.deletequestion')
    @include('screens.backend.questionquiz.components.renders.formcreate')
    @include('screens.backend.questionquiz.components.renders.formupdate')
@endpush
