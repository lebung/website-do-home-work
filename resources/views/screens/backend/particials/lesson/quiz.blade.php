<form action="{{ route('admin.lesson.addQuiz', $lesson->id) }}" class="has-validation-ajax" method="POST">
    @csrf
    <div class="alert alert-info">Bài học: <p class="font-weight-bolder">{{ $lesson->title }}</p></div>
    <div class="form-group">
        <input type="text" class="form-control search-quiz" placeholder="Tìm kiếm quiz...">
    </div>
    <table class="table hidden-thead" id="style-11" data-scroll="true" data-wheel-propagation="true" style="max-height: 400px;overflow-y:auto;display: block">
        <thead>
            <tr>
                <th style="width:5%"><p>Chọn</p></th>
                <th><p>Tên Quiz</p></th>
                <th><p>Thời gian làm</p></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($quizs as $quiz)
            <tr>
                <td>
                    <label class="checkbox">
                        <input type="checkbox" value="{{ $quiz->id }}" name="quizs[]" @checked($lesson->quizs->contains('id', $quiz->id))>
                        <span></span></label>
                </td>
                <td class="font-weight-bold title">{{ $quiz->title }}</td>
                <td class="font-weight-bold">{{ $quiz->duration }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <p class="text-danger errors quizs"></p>
    <button type="submit" class="btn btn-primary">Lưu lại</button>
</form>

<script>
    $(document).ready(function(){
        $('.search-quiz').keyup(function(){
            let value = $(this).val()
            $('table>tbody>tr>td.title').each((index, element) => {
                if($(element).text().toLowerCase().includes(value.toLowerCase())){
                    $(element).parent('tr').show()
                } else {
                    $(element).parent('tr').hide()
                }
            })
        })
    })
</script>