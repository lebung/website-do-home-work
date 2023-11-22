<div class="card card-custom">
    <div class="card-body">
        <!--begin: Datatable-->
        <div id="kt_datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
            <div>
                <form action="" id="user-has-validation-ajax" method="post">
                    @csrf
                    <div>
                        @livewire('search-user')
                    </div>
                    <button type="submit" form="user-has-validation-ajax" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <!--end: Datatable-->
</div>



