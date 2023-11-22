<form action="{{ route('admin.section.store') }}" class="has-validation-ajax" method="POST">
    @csrf
    <p class="text-danger errors system"></p>
    <input type="hidden" name="course" value="{{ $course }}">
    <div class="form-group">
        <label>Tên chương học</label>
        <input type="text" name="title" placeholder="Nhập tên chương học..." class="form-control">
        <p class="text-danger errors title"></p>
    </div>
    <button type="submit" class="btn btn-primary font-weight-bold">Thêm</button>
</form>
