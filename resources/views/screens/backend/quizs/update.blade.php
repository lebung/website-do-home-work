<div class="card card-custom">
    <div class="card-body">
        <!--begin: Datatable-->
        <div id="kt_datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
            <div class="row">
                <div class="col-12">
                    <form action="{{route('admin.quiz.update', $quiz->id)}}" id="form-update"
                          class="has-validation-ajax" method="POST">
                        @csrf
                        @method('PUT')
                        <div>
                            <div>
                                <div class="form-group">
                                    <label>Title
                                        <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control"
                                           name="title" value="{{$quiz->title}}" placeholder="Enter Title"/>
                                    <p class="text-danger errors title"></p>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Duration
                                                <span class="text-danger">*</span></label>
                                            <input type="number"
                                                   class="form-control"
                                                   name="duration" value="{{$quiz->duration}}"
                                                   placeholder="Enter duration"/>
                                            <p class="text-danger errors duration"></p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Limit
                                                <span class="text-danger">*</span></label>
                                            <input type="number"
                                                   class="form-control "
                                                   name="limit" value="{{$quiz->limit}}" placeholder="Enter limit "/>
                                            <p class="text-danger errors limit"></p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div>
                                @livewire('search-by-update', ['quiz' => $quiz])
                            </div>

                            <input type="text" value="{{$arrayQues}}"
                                   id="questionsUpdate" hidden
                                   name="questions">
                        </div>
                        <button type="submit" form="form-update" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <!--end: Datatable-->
    </div>
</div>

