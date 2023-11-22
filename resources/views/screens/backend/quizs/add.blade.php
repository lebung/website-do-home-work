<div class="card card-custom">
    <div class="card-body">
        <!--begin: Datatable-->
        <div id="kt_datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
            <div>
                <form action="{{route('admin.quiz.store')}}" id="form" class="has-validation-ajax" method="post">
                    @csrf
                    <div>
                        <div>
                            <div class="form-group">
                                <label>Title
                                    <span class="text-danger">*</span></label>
                                <input type="text" class="form-control"
                                       name="title" placeholder="Enter Title"/>
                                <p class="text-danger errors title"></p>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Duration
                                            <span class="text-danger">*</span></label>
                                        <input type="number"
                                               class="form-control"
                                               name="duration" placeholder="Enter duration"/>
                                        <p class="text-danger errors duration"></p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Limit
                                            <span class="text-danger">*</span></label>
                                        <input type="number"
                                               class="form-control"
                                               name="limit" placeholder="Enter limit "/>
                                        <p class="text-danger errors limit"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            @livewire('search')
                        </div>
                        <input type="text" hidden value="" id="questions" name="questions">
                    </div>
                    <button type="submit" form="form" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <!--end: Datatable-->
</div>



