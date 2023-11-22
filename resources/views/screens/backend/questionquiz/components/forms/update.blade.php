<form class="form" enctype="multipart/form-data" method="post" id="formupdate">
    @csrf
    @isset($type)
        <div class='form-group mt-5'>
            <div id="form-errors-update">
            </div>
            <label>Câu hỏi</label>
            <textarea rows='2' placeholder='Nhập câu hỏi...' class='form-control' name='title' value="{{ $question->title }}">{{ $question->title }}</textarea>
            <input type='number' hidden name='type' value='{{ $type }}'>
            <input type="number" hidden name="id" value="{{ $question->id }}">

            <div class="card-body">
                <div class="tab-content" id="tab-content">
                    <div class="tab-pane fade show active" id="kt_tab_pane_0_2" role="tabpanel"
                        aria-labelledby="kt_tab_pane_2">
                        <div class="form-group">
                            <label>Ảnh slide</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input file-image" name="attachment"
                                    accept=".png, .jpg, .jpeg, .jfif, .webp" id="customFile">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                            <div class="preview-image new"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group mt-3">
                <label class="col-form-label ">Tags</label>
                <input id="kt_tagify_1" class="form-control tagify" name='tag' placeholder="Nhập Tag..."
                    value='{{ $question->tag }}' autofocus="" />
                <div class="mt-3">
                    <a href="javascript:;" id="kt_tagify_1_remove"
                        class="btn btn-sm btn-light-primary font-weight-bold">Remove tags</a>
                </div>
            </div>
        </div>
        <hr>
        <h3>
            <i class="flaticon-questions-circular-button display-4 text-success"></i>
            @switch($type)
                @case(0)
                    Câu hỏi trắc nghiệm đúng sai
                @break

                @case(1)
                    Câu hỏi trắc nghiệm 1 lựa chọn
                @break

                @case(2)
                    Câu hỏi trắc nghiệm nhiều lựa chọn
                @break

                @case(3)
                    Câu hỏi tự luận
                @break

                @default
                    Câu hỏi ghép đáp án
            @endswitch
        </h3>
        <div class='form-group' id="ListAnswersUpdate">
            @foreach ($question->answers as $key => $a)
                @if ($type != 3)
                    <div class='Answer_put'>
                        <input type="number" name="id_answer[]" value="{{ $a->id }}" hidden>
                        @if ($type != 0)
                            <label for="question-stt">Câu trả lời {{ $key + 1 }}</label>
                            <textarea rows='2' placeholder='Nhập câu hỏi...' name='content[]' class='form-control'
                                value="{{ $a->content }}">{{ $a->content }}</textarea>
                        @endif
                        <div class='d-flex justify-content-between tools-answer'>
                            <div class='form-group '>
                                <label class='col-form-label'>Xác thực</label>
                                <select class="form-control" aria-label="Default select example" name="is_correct[]"
                                    onchange="option_answer(this,{{ $type }})">
                                    <option value="1" {{ $a->is_correct == 1 ? 'selected' : '' }}>Đúng</option>
                                    <option value="0" {{ $a->is_correct == 0 ? 'selected' : '' }}>Sai</option>
                                </select>
                            </div>
                            @if ($type != 0 && $type < 3)
                                <div class=''>
                                    <a class="btn btn-light  btn-sm"
                                        onclick="DeleteAnswerUpdate(this,{{ $a->id }})">
                                        <i class="flaticon2-trash text-danger"></i>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        @if ($type != 0 && $type < 3)
            <div onclick='addAnswerUpdate()' class='btn btn-primary'><i class='fas fa-plus-square'></i>Thêm câu trả lời
            </div>
        @endif
        <hr>
        <div class="d-flex justify-content-between mt-3">
            <button type="button" class="btn btn-success font-weight-bold" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="update_form(this)">Lưu</button>
        </div>
    @endisset
</form>
