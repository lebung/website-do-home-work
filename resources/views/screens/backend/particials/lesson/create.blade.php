<div class="alert alert-info mb-3">
    Khóa học: <span class="font-weight-bolder">{{ $course->title }}</span>
</div>

<div class="alert alert-success">
    Dạng bài học: <span class="font-weight-bolder">{{ config("common.lesson_type.{$type}") }}</span>
    <a onclick="showAjaxModal('{{ route('admin.lesson.selecttype', ['course' => $course->id, 'type' => $type]) }}', 'Thêm bài học')" class="btn btn-link-dark font-weight-bold ml-3">Thay đổi</a>
</div>

<form action="{{ route('admin.lesson.store', $course->id) }}" class="has-validation-ajax" method="POST" enctype="multipart/form-data">
    @csrf
    <p class="text-danger errors system"></p>
    <input type="hidden" name="lesson_type" value="{{$type}}">
    <div class="form-group">
        <label>Tên bài học</label>
        <input type="text" class="form-control" placeholder="Nhập tên bài học" name="title">
        <p class="text-danger errors title"></p>
    </div>
    <div class="form-group">
        <label>Chương học</label>
        <select name="section_id" id="section_id" class="form-control">
            @foreach ($sections as $s)
                <option value="{{ $s->id }}">{{ $s->title }}</option>
            @endforeach
        </select>
        <p class="text-danger errors section_id"></p>
    </div>
    @if ($type == 'video')
    <div class="form-group">
        <label>File Browser</label>
        <div></div>
        <div class="custom-file">
            <input type="file" name="video_file" accept=".mp4" class="custom-file-input" id="customFileVideo" />
            <label class="custom-file-label" for="customFileVideo">Chọn file mp4</label>
        </div>
        <p class="text-danger errors video_file"></p>
    </div>
    @elseif ($type == 'youtube')
    <div class="form-group">
        <label>Đường dẫn video</label>
        <input type="text" name="video_url" placeholder="https://www.youtube.com/watch?v=sLq57LTJ8VU" class="form-control">
        <p class="text-danger errors video_url"></p>
    </div>
    @elseif ($type == 'document')
    <div class="form-group">
        <label>File Browser</label>
        <div></div>
        <div class="custom-file">
            <input type="file" name="doc_file" accept=".doc, .docx, .pdf" class="custom-file-input" id="customFileVideo" />
            <label class="custom-file-label" for="customFileVideo">Chọn tệp tài liệu word, pdf</label>
        </div>
        <p class="text-danger errors doc_file"></p>
    </div>
    @endif
    <div class="form-group">
        <label>Nội dung</label>
        <textarea name="text_content" class="form-control" placeholder="Nhập nội dung"></textarea>
    </div>

    <div class="form-group file-attachment">
        <label>Tệp đính kèm</label>
        <div class="custom-file mb-3">
            <input type="file" class="custom-file-input attachment" accept=".doc, .docx, .pdf, .zip" name="attachment[]" id="attachment0" />
            <label class="custom-file-label" for="attachment0">Choose file</label>
            <p class="text-danger errors attachment0"></p>
        </div>
        <button type="button" class="btn btn-primary btn-sm mt-3 add-file-attachment">Thêm tệp đính kèm</button>
        <span class="text-muted">Tệp đính kèm dạng doc, pdf, zip, txt</span>
    </div>
    <button class="btn btn-success d-block m-auto">Thêm bài học</button>
</form>

<script>
    $(document).ready(function(){
        CKEDITOR.replace('text_content')
        $('#section_id').select2()
        $('.add-file-attachment').on('click', function(){
            let fileAttachLength = $('.attachment').length
            let attach = `<div class="custom-file mb-3">
                            <input type="file" class="custom-file-input attachment" accept=".doc, .docx, .pdf, .zip" name="attachment[]" id="attachment${fileAttachLength}" />
                            <label class="custom-file-label" for="attachment${fileAttachLength}">Choose file</label>
                            <p class="text-danger errors attachment${fileAttachLength}"></p>
                        </div>`
            $(this).before(attach)
        })
    })
</script>