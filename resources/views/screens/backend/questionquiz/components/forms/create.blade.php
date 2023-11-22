@isset($type)
    <input type='number' hidden name='type' value="{{ $type }}">
    <h3>
        <i class="flaticon-questions-circular-button display-4 text-success"></i>
        @switch($type)
            @case(0)
                Câu trắc nghiệm đúng sai
            @break

            @case(1)
                Câu trắc nghiệm 1 lựa chọn
            @break

            @case(2)
                Câu trắc nghiệm nhiều lựa chọn
            @break

            @case(3)
                Câu tự luận
            @break

            @default
                Câu ghép đáp án
        @endswitch()
    </h3>

    <div class="form-group mt-3">
        <label class="col-form-label ">Tags</label>
        <input id="kt_tagify_1" class="form-control tagify" name='tag' placeholder="Nhập Tag..." autofocus="" />
        <div class="mt-3">
            <a href="javascript:;" id="kt_tagify_1_remove" class="btn btn-sm btn-light-primary font-weight-bold">Remove
                tags</a>
        </div>
    </div>
    </div>

    <hr>
    @if ($type != 3)
        <div class='form-group' id="ListAnswersCreate">

            <div class='AnswerCreate'>
                @if ($type != 0)
                    <label for="question-stt">Câu trả lời 1</label>
                    <textarea rows='2' placeholder='Nhập câu hỏi...' name='content[]' class='form-control'></textarea>

                    <div class='d-flex justify-content-between tools-answer'>
                        <div class='form-group'>
                            <label class='col-form-label'>Xác thực</label>

                            <select class="form-control" aria-label="Default select example" name="is_correct[]"
                                onchange="option_answer(this,{{ $type }})">
                                <option value="1" selected>Đúng</option>
                                <option value="0">Sai</option>
                            </select>
                        </div>
                    </div>
                @endif

                @if ($type == 0)
                    <div class='d-flex justify-content-between align-items-center tools-answer'>
                        <strong class="mx-3">True</strong>
                        <input type="text" name="content[]" value="true" hidden>
                        <select class="form-control" aria-label="Default select example" name="is_correct[]"
                            onchange="option_answer(this,{{ $type }})">
                            <option value="1" selected>Đúng</option>
                            <option value="0">Sai</option>
                        </select>
                        <strong class="mx-3">False</strong>
                        <input type="text" name="content[]" value="false" hidden>
                        <select class="form-control" aria-label="Default select example" name="is_correct[]"
                            onchange="option_answer(this,{{ $type }})">
                            <option value="1">Đúng</option>
                            <option value="0" selected>Sai</option>
                        </select>
                    </div>
                @endif
            </div>

        </div>

        @if ($type != 0)
            <div onclick='addAnswercreate({{ $type }})' class='btn btn-primary'><i
                    class='fas fa-plus-square'></i>Thêm
                câu trả
                lời
            </div>
        @endif
    @endif
    <hr>
    <div class="d-flex justify-content-between mt-3">
        <button type="button" class="btn btn-success font-weight-bold" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="create_form(this)">Lưu</button>
    </div>
@endisset
