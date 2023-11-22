<form action="{{ route('admin.section.processSort', $course->id) }}" method="POST">
    @method('PATCH')
    @csrf
    <div class="card bg-light card-custom gutter-b">
        <div class="card-header">
            <div class="card-title">
                <h4 class="card-label">
                Khóa học: {{ $course->title }}
                </h4>
            </div>
        </div>
        <div class="card-body sections">
            @foreach ($course->sections as $s)
            <div class="col-md-12 mb-3">
                <input type="hidden" name="sections[]" value="{{ $s->id }}">
                <span class="bg-white d-flex p-5 d-flex justify-content-between align-content-center">
                    <p class="lession-name">{{ $s->title }}</p>
                </span>
            </div>
            @endforeach
        </div>
    </div>
    <button type="submit" class="btn btn-primary d-block m-auto">Lưu lại</button>
</form>

<script>
    $(document).ready(function(){
        $('.card-body.sections').sortable({
            cursor: "move"
        })
    })
</script>