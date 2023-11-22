@extends('layouts.backend.master')

@section('title', 'Trang Quản Trị')

@section('content')
    <!--begin::Card-->
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <span class="card-icon">
                    <i class="flaticon2-favourite text-primary"></i>
                </span>
                <h3 class="card-label">List Quizzes</h3>
            </div>

            <div class="card-toolbar">
                <button type="button" class="btn btn-primary font-weight-bolder" data-toggle="modal"
                        data-target="#formCreate">
                    New Record
                </button>
            </div>
        </div>
        @livewire('search-quiz')
    </div>
    <!--end::Card-->
    <div class="modal fade" id="formCreate" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Quizz</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    @include('screens.backend.quizs.add')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="formUpdate" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Quizz</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body-update">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="formInsert" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Insert User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body-user">
                    @include('screens.backend.quizs.insert')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="formClass" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Insert Classroom</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body-user">
                    @include('screens.backend.quizs.insert-class')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-js-tag')
    <script>
        function showQuiz(id) {
            let _url = "{{route('admin.quiz.edit', ':id')}}";
            _url = _url.replace(':id', id);
            let _method = 'get';
            let modalBody = document.querySelector('.modal-body-update');
            $.ajax({
                url: _url,
                type: _method,
                dataType: 'JSON',
                success: function (res) {
                    modalBody.innerHTML = res;
                }
            })
        }

        id = '';

        function getId(id_quiz){
            id = id_quiz

            return id;
        }

        console.log(id);
    </script>

    <script>
        $(document).ready(function () {
            $(document).on('submit','#class-has-validation-ajax', function(e){
                e.preventDefault();
                let data = new FormData(this);
                let _url = "http://127.0.0.1:8000/admin/quiz/insert_classroom/" + getId(id);
                let _method = $(this).attr('method');
                $.ajax({
                    url: _url,
                    method: _method,
                    data: data,
                    contentType:false,
                    processData:false,
                    success: function(res){
                        Swal.fire({
                            icon: 'success',
                            title: 'Action successful',
                            showConfirmButton: true,
                        }).then(function () {
                            window.location.href='http://127.0.0.1:8000/admin/quiz'
                        })
                    }
                })
            })
            $(document).on('submit', '#user-has-validation-ajax', function (e) {
                e.preventDefault()
                let data = new FormData(this);
                let _url = "http://127.0.0.1:8000/admin/quiz/insert_user/" + getId(id);
                let _method = $(this).attr('method');
                $.ajax({
                    url: _url,
                    method: _method,
                    data: data,
                    contentType: false,
                    processData: false,
                    success: function (res) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Action successful',
                            showConfirmButton: true,
                        }).then(function () {
                            window.location.href='http://127.0.0.1:8000/admin/quiz'
                        })
                    }
                })
            })
            $(document).on('submit', 'form.has-validation-ajax', function (e) {
                let _this = $(this)
                e.preventDefault()
                let data = new FormData(this)
                let _action = $(this).attr('action')
                let _method = $(this).attr('method')
                $.ajax({
                    url: _action,
                    method: _method,
                    data: data,
                    contentType: false,
                    processData: false,
                    success: function (res) {
                        Swal.fire({
                            // position: 'top-end',
                            icon: 'success',
                            title: 'Action successful',
                            showConfirmButton: true,
                        }).then(function () {
                            window.location.href='http://127.0.0.1:8000/admin/quiz'
                        })

                    },
                    error: function (err) {
                        console.log(err.responseJSON)
                        let errors = err.responseJSON.errors
                        Object.keys(errors).forEach(key => {
                            $('p.errors.' + key).text(errors[key][0])
                        })
                    }
                })
            })
            $(document).on('click', '.button-delete', function (e) {
                e.preventDefault();
                console.log(e)
                let _action = $(this).attr('href');
                console.log(_action)
                let _method = 'get'
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then( function () {
                    $.ajax({
                        url: _action,
                        method: _method,
                        success: function (res) {
                            console.log(res);
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            ).then(function () {
                                window.location.href='http://127.0.0.1:8000/admin/quiz'
                            });
                        },
                        error: function (){
                            Swal.fire(
                                'Cancelled',
                                'Your quiz cant delete',
                                'error'
                            ).then(function () {
                                window.location.href='http://127.0.0.1:8000/admin/quiz'
                            });
                        }
                    })
                })
            })
        })
    </script>
@endsection
