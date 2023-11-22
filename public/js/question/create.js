
function addAnswercreate(type) {
    const ListAnswer = document.querySelector('#ListAnswersCreate');
    let i = ListAnswer.children.length
    let elm = document.createElement("div")
    elm.classList.add('AnswerCreate')
    elm.innerHTML = `<label for="question-stt">Câu trả lời ${i + 1}</label>
    <textarea rows="2" placeholder="Nhập câu hỏi..." name="content[]" class="form-control"></textarea>
    <div class="d-flex justify-content-between tools-answer">
        <div class="form-group">
            <label class="">Xác thực</label>
            <select class="form-control" aria-label="Default select example" name="is_correct[]" onchange="option_answer(this,${type})">
            <option value="1">Đúng</option>
            <option value="0" selected>Sai</option>
        </select>
        </div>
        <div class="">
            <div class="btn btn-light  btn-sm" border="none" placement="top" onclick='DeleteAnswercreate(this)'
                ngbTooltip="Xóa"><i class="flaticon2-trash text-danger"></i></div>
        </div>
    </div>`
    ListAnswer.appendChild(elm);
}

function DeleteAnswercreate(elm) {
    const ListAnswer = document.querySelector('#ListAnswersCreate');
    let elmAnswer = elm.closest('.AnswerCreate')
    ListAnswer.removeChild(elmAnswer);
    document.querySelectorAll('.AnswerCreate').forEach((element, index) => {
        element.querySelector('label[for="question-stt"]').innerText = `Câu trả lời ${index + 1} `
    });
}