<script>
    function show_update(elm, a) {
        let _url = '{{ route('question.update', ['id' => ':id']) }}'
        _url = _url.replace(':id', a)
        axios.get(_url).then(
            (val) => {
                document.querySelector('#modal-body-update').innerHTML = val.data
                document.querySelector('#form-errors-update').innerHTML = ''
                setTimeout(() => {
                    KTTagifyDemos.init()
                }, 50);
            }
        )
    }

    function DeleteAnswerUpdate(elm, a = 0) {
        if (a == 0) {
            delete_res(elm)
            return
        }
        let _url = '{{ route('question.destroy', ['id' => ':id']) }}'
        _url = _url.replace(':id', a)
        axios.delete(_url).then((data) => {
            delete_res(elm)
        })
    }

    function delete_res(elm) {
        const ListAnswerUpdate = document.querySelector('#ListAnswersUpdate');
        elm = elm.closest('.Answer_put')
        ListAnswerUpdate.removeChild(elm);
        let listAns = document.querySelectorAll('.Answer_put')
        listAns.forEach((elm, index) => {
            elm.querySelector('label[for="question-stt"]').innerText = `Câu trả lời ${index + 1}`
        })
    }

    function update_form() {
        const formData = new FormData(document.querySelector('#formupdate'));
        let _form = document.querySelector('#formupdate')
        let valueTag = JSON.parse(formData.get('tag'))
        valueTag = valueTag.map(val => val.value).join(',')
        formData.set('tag', valueTag)
        axios.post('{{ route('question.edit') }}', formData)
            .then(
                (res) => {
                    Swal.fire(
                            'Bạn cập nhật thành công',
                            'You clicked the button!',
                            'success'
                        )
                        .then(
                            data => {
                                document.querySelector('#modal-body-update').innerHTML = res.data
                                KTTagifyDemos.init()
                            }
                        )
                }
            )
            .catch(
                (res) => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Bạn nhập sai',
                        text: 'Mời bạn nhập lại!',
                    })
                    document.querySelector('#form-errors-update').innerHTML = `@include('screens.backend.questionquiz.components.layout.formerror')`
                    let arr = [];
                    for (const key in res.response.data.errors) {
                        arr.push(`<div>${key}: ${res.response.data.errors[key]}</div>`)
                    }
                    document.querySelector(`#show-errors`).innerHTML = arr.join('')
                }
            )
    }
</script>
