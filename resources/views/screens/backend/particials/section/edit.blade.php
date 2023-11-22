<form action="{{ route('admin.section.update', $section->id) }}" method="POST">
    @csrf 
    @method('PUT')
    <input type="hidden" name="course" value="{{ $course }}">
    <div class="form-group">
        <label>Tên chương học</label>
        <input type="text" value="{{ $section->title }}" name="title" placeholder="Nhập tên chương học..." class="form-control">
    </div>
    <button type="submit" class="btn btn-primary font-weight-bold">Cập nhật</button>
</form>