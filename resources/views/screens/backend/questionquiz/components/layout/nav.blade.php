<div class="card-title">
    <h3 class="card-label">List Questions & Answers
        <span class="d-block text-muted pt-2 font-size-sm">light head and row separator</span>
    </h3>
</div>
<div class="card-toolbar">

    <div class="row align-items-center">
        <div class="col-lg-9 col-xl-10">

            <div class="row align-items-center m-2">
                <div class="col-md-4 my-2 my-md-0">
                    <div class="input-icon">
                        <input type="text" class="form-control" placeholder="Search..." id="search" oninput="search(this)" value=""
                            name="search" value=""/>
                        <span>
                            <i class="flaticon2-search-1 text-muted"></i>
                        </span>
                    </div>
                </div>
                <div class="col-md-4 my-2 my-md-0">
                    <div class="d-flex align-items-center">
                        <label class="mr-3 mb-0 d-none d-md-block">Sort:</label>
                        <select class="form-control" id="author" onchange="sortId(this)">
                            <option value="0">DESC</option>
                            <option value="1">ASC</option>
                        </select>
                    </div>
                </div>
                <div class="">
                    <a type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalcreate"
                    onclick="show_form_create(0)">
                    <i class="la la-plus"></i>New Record</a>
                </div>
            </div>
        </div>

    </div>
</div>
