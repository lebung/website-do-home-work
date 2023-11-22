<div class="row">
    @foreach ($course_category as $item)
            <div class="col-md-6 col-lg-6 col-xl-4 on-hover-action mt-4" id="1">
                <div class="card d-block">
                    <img class="card-img-top" src="{{ asset($item->thumbnail) }}" height="300px" alt="Card image cap">
                    <div class="card-body">
                        <h4 class="card-title mb-0">{{ $item->name }}</h4>
                        <small style="font-style: italic;">
                            <p class="card-text"></p>
                        </small>
                    </div>
                    <ul class="list-group list-group-flush">
                        @if ($item->childs->count() > 0)
                        @foreach ($item->childs as $item1)
                                <li class="list-group-item on-hover-action" id="2">
                                    <span><i class="ki ki-plus mr-2 text-info"></i>{{ $item1->name }}
                                        <div style="float: right;">
                                            {{-- <a href="{{route('course_category.delete',$item1)}}"  onclick=" return confirm('Bạn có muốn xóa {{$item1->name}} không ?')">
                        <i class="fas fa-trash mr-2"></i></a> --}}
                                            <a href="#" data-toggle="modal" data-target="#editItemModal"
                                                onclick="javascript:editItem({{ $item1 }})"> <i
                                                    class="ki ki-wrench"></i></a>
                                        </div>
                                    </span>
                                </li>
                        @endforeach
                        @endif
                    </ul>
                    <div class="card-body">
                        <a href="#" data-toggle="modal" data-target="#exampleModal"
                            onclick="javascript:edit_course_category({{ $item }})"
                            class="btn btn-outline-info btn-sm">
                            <i class="ki ki-wrench btn-outline-info"></i> Edit </a>
                        <a href="#" class="btn btn-outline-success btn-sm "
                            onclick="javascript:add_courseItem({{ $item }})" data-toggle="modal"
                            data-target="#addItemModal" style="float: right;">
                            <i class="ki ki-plus btn-outline-success"></i> Add Item </a>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div>
    @endforeach
</div>
