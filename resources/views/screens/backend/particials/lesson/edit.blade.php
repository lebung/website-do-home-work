<div class="alert alert-info mb-3">
    Khóa học: <span class="font-weight-bolder">{{ $lesson->course->title }}</span>
</div>

<form action="{{ route('admin.lesson.update', $lesson->id) }}" class="has-validation-ajax" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <p class="text-danger errors system"></p>
    <input type="hidden" name="lesson_type" value="{{ ($lesson->lesson_type == 'video' && $lesson->video_type == 'system') ? 'video' : (($lesson->lesson_type == 'video' && $lesson->video_type == 'youtube') ? 'youtube' : $lesson->lesson_type)   }}">
    <div class="form-group">
        <label>Tên bài học</label>
        <input type="text" value="{{ $lesson->title }}" class="form-control" placeholder="Nhập tên bài học" name="title">
        <p class="text-danger errors title"></p>
    </div>
    <div class="form-group">
        <label>Chương học</label>
        <select name="section_id" id="section_id" class="form-control">
            @foreach ($sections as $s)
                <option value="{{ $s->id }}" @selected($s->id == $lesson->section_id)>{{ $s->title }}</option>
            @endforeach
        </select>
        <p class="text-danger errors section_id"></p>
    </div>
    @if ($lesson->lesson_type == 'video' && $lesson->video_type == 'system')
    <div class="form-group">
        <label>File Browser</label>
        <div></div>
        <div class="custom-file">
            <input type="file" name="video_file" accept=".mp4" class="custom-file-input" id="customFileVideo" />
            <label class="custom-file-label" for="customFileVideo">Chọn file mp4</label>
        </div>
        <p class="text-danger errors video_file"></p>
    </div>
    @elseif ($lesson->lesson_type == 'video'  && $lesson->video_type == 'youtube')
    <div class="form-group">
        <label>Đường dẫn video</label>
        <input type="text" name="video_url" value="{{ $lesson->video_path }}" placeholder="https://www.youtube.com/watch?v=sLq57LTJ8VU" class="form-control">
        <p class="text-danger errors video_url"></p>
    </div>
    @elseif ($lesson->lesson_type == 'document')
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
        <textarea name="text_content" class="form-control" placeholder="Nhập nội dung">{{ $lesson->content }}</textarea>
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
    <button class="btn btn-success d-block m-auto">Cập nhật</button>
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