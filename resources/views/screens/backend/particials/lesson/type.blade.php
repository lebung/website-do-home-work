<div class="alert alert-info">
    Khóa học: <span class="font-weight-bold">{{ $course->title }}</span>
</div>

<h5 class="header-title mt-5 mt-sm-0">Chọn kiểu bài học:</h5>

<div class="mt-3">
    <div class="form-group">
        <div class="radio-list">
            <label class="radio">
            <input type="radio" name="lesson_type" value="youtube" checked>
                <span></span>Youtube Video</label>
            <label class="radio">
                <input type="radio" name="lesson_type" value="video" @checked($type == 'video')>
                <span></span>Video File</label>
            <label class="radio">
                <input type="radio" name="lesson_type" value="document" @checked($type == 'document')>
                <span></span>File tài liệu</label>
            <label class="radio">
                <input type="radio" name="lesson_type" value="text" @checked($type == 'text')>
                <span></span>Văn bản</label>
        </div>
    </div>

    <div class="mt-3">
        <a href="javascript::void(0)"
        type="button"
        class="btn btn-primary"
        data-toggle="modal"
        data-dismiss="modal"
        id = "lesson-add-modal"
        onclick="showLessonAddModal()">Tiếp theo</a>
    </div>
</div>

<script>
    function showLessonAddModal(){
        let _url = '{{ route('admin.lesson.create', ['course' => ':course', 'type' => ':type']) }}'
        _url = _url.replace(':course', {{ $course->id }})
        _url = _url.replace(':type', $('[name="lesson_type"]:checked').val())
        showAjaxModal(_url, 'Thêm bài học')
    }
</script>