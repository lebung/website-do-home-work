<div class='form-group'>
    <label>Câu hỏi</label>
    <textarea rows='2' placeholder='Nhập câu hỏi...' class='form-control' name='title' value="{{ $question->title }}">{{ $question->title }}</textarea>
    <input type='number' hidden name='type' value='1'>
    <input type="number" hidden name="id" value="{{ $question->id }}">
    <div class="image-input image-input-outline mt-3" id="kt_image_1">
        <div class="image-input-wrapper" style="background-image: url(assets/media/users/100_1.jpg)"></div>

        <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change"
            data-toggle="tooltip" title="" data-original-title="Change avatar">
            <i class="fa fa-pen icon-sm text-muted"></i>
            <input type="file" name="attachment" accept=".png, .jpg, .jpeg" />
            <input type="hidden" name="profile_avatar_remove" />
        </label>

        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel"
            data-toggle="tooltip" title="Cancel avatar">
            <i class="ki ki-bold-close icon-xs text-muted"></i>
        </span>
    </div>

    <textarea rows='2' placeholder='Nhập Tag...' name='tag' class='form-control mt-3'
        value='{{ $question->tag }}'>{{ $question->tag }}</textarea>

</div>

<hr>
<div class='form-group' id="ListAnswersUpdate">
    @foreach ($question->answers as $key => $a)
        <div class='Answer_put'>
            <label>Câu trả lời</label>
            <input type="text" name="id_answer_delete[]" value="{{$a->id}}" hidden>
            <textarea rows='2' placeholder='Nhập câu hỏi...' name='content[]' class='form-control'
                value="{{ $a->content }}">{{ $a->content }}</textarea>
            <div class='d-flex justify-content-between tools-answer'>
                <div class='form-group row'>
                    <label class='col-3 col-form-label'>Xác thực</label>
                    <div class='col-9 col-form-label'>
                        <div class='radio-inline'>
                            <label class='radio radio-success'>
                                <input type='radio' name='is_correct{{ $key }}' value='1'
                                    {{ $a->is_correct == 1 ? 'checked' : '' }} />
                                <span></span>
                                True
                            </label>
                            <label class='radio radio-danger'>
                                <input type='radio' name='is_correct{{ $key }}' value='0'
                                    {{ $a->is_correct == 0 ? 'checked' : '' }} />
                                <span></span>
                                False
                            </label>
                        </div>
                        <span class='form-text text-muted'>Some help text goes here</span>
                    </div>
                </div>
                <div class=''>
                    <div class='bg-danger btn btn-danger mt-2' border='none' placement='top' ngbTooltip='Xóa'
                        onclick="DeleteAnswerupdate(this,{{$a->id}})"><i class='fas fa-trash text-white'></i></div>
                </div>
            </div>
        </div>
    @endforeach
</div>
<div onclick='addAnswerUpdate()' class='btn btn-primary'><i class='fas fa-plus-square'></i>Thêm câu trả lời</div>
