
function addAnswerUpdate() {
    const ListAnswer = document.querySelector('#ListAnswersUpdate');
    let i_put = document.querySelectorAll('.Answer_put').length
    elm = document.createElement("div")
    elm.classList.add('Answer_put')
    elm.innerHTML = `<label for="question-stt">Câu trả lời ${i_put + 1}</label>
    <textarea rows="2" placeholder="Nhập câu hỏi..." name="content[]" class="form-control"></textarea>
    <div class="d-flex justify-content-between tools-answer">
        <div class="form-group">
            <label class="col-form-label">Xác thực</label>
                <div class="radio-inline">
                <select class="form-control" aria-label="Default select example" name="is_correct[]">
                <option value="1" selected>Đúng</option>
                <option value="0">Sai</option>
            </select>
            </div>
        </div>
        <div class="">
            <div class="btn btn-light  btn-sm" border="none" placement="top" onclick='DeleteAnswerUpdate(this)'
                ngbTooltip="Xóa"><i class="flaticon2-trash text-danger"></i></div>
        </div>
    </div>`
    ListAnswer.appendChild(elm);
}
