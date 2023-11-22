<!--begin: Datatable-->
<table class="table  table-separate table-head-custom table-checkable" id="kt_datatable">
    <thead>
        <tr>
            <th>Title</th>
            <th>Type</th>
            <th>Tags</th>
            <th>attachment</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody id="list_questions">
        @forelse ($questions as $question)
            <tr id="question-in-list">
                <td>{{ $question->title }}</td>
                <td>{{ $question->type }}</td>
                <td><a class="btn btn-light  btn-sm" data-toggle="modal" data-target="#exampleModalshowTags" >
                <i class="flaticon2-tag text-success"></i>    
                </a></td>
                <th>{{$question->attachment}}</th>
                <td>
                    <a class="btn btn-light  btn-sm" data-toggle="modal" data-target="#exampleModalupdate" onclick="show_update(this,{{ $question->id }})">
                        <i class="ki ki-reload text-warning"></i></a>

                    <a class="btn btn-light  btn-sm" onclick="delete_question(this,{{ $question->id }})">
                        <i class="flaticon2-trash text-danger"></i></a>
                </td>
            </tr>
        @empty
        @endforelse
    </tbody>
</table>
<!--end: Datatable-->

<div class="d-flex justify-content-between align-items-center flex-wrap">
    <div class="d-flex flex-wrp py-2 mr-3">
        <a href="#" class="btn btn-icon btn-sm btn-light-success mr-2 my-1" onclick="paingation(1)"><i class="ki ki-bold-double-arrow-back icon-xs"></i></a>
        @for ($i = 1; $i <= $questions->lastPage(); $i++)
        <a href="#" class="btn btn-icon btn-sm border-0 btn-hover-success mr-2 my-1" onclick="paingation({{$i}})">{{$i}}</a>
        @endfor
        <a href="#" class="btn btn-icon btn-sm btn-light-success mr-2 my-1" onclick="paingation({{$questions->lastPage()}})"><i class="ki ki-bold-double-arrow-next icon-xs"></i></a>
    </div>
    <div class="d-flex align-items-center py-3">
        <select class="form-control form-control-sm text-success font-weight-bold mr-4 border-0 bg-light-primary" style="width: 75px;">
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="30">30</option>
            <option value="50">50</option>
            <option value="100">100</option>
        </select>
        <span class="text-muted">Displaying {{count($questions)}} of {{$questions->total()}} records</span>
    </div>
</div>
