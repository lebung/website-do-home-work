<script>
    function clicktab(index) {
        document.querySelectorAll('#tab-content .tab-pane').forEach((element, i) => {
            element.querySelector("input[type=file]").value = null
            if (index == i) {
                element.querySelector("input[type=file]").name = "attachment"
            } else {
                element.querySelector("input[type=file]").name = ""
            }
        })
    }

    function show_form_create(a) {
        let _url = '{{ route('question.create', ['type' => ':type']) }}'
        _url = _url.replace(':type', a)
        axios.get(_url)
            .then(
                (res) => {
                    const typeOption = document.querySelector('#my-options')
                    typeOption.innerHTML = res.data
                    document.querySelectorAll("input[type=file]")[0].name = "attachment"
                    document.querySelector('#form-errors-create').innerHTML = ''
                    KTTagifyDemos.init()
                }
            )
    }

    function create_form(elm) {
        const formData = new FormData(document.querySelector('#formcreate'));
        if (formData.get('tag') != '') {
            let valueTag = JSON.parse(formData.get('tag'))
            valueTag = valueTag.map(val => val.value).join(',')
            formData.set('tag', valueTag)
        }
        axios.post('{{ route('question.store') }}', formData)
            .then(
                (res) => {
                    Swal.fire(
                            'Bạn thêm thành công!',
                            'You clicked the button!',
                            'success'
                        )
                        .then(val => window.location.assign("{{ route('question.list') }}"))
                }
            )
            .catch(
                (res) => {
                    console.log(res);
                    Swal.fire({
                        icon: 'error',
                        title: 'Bạn nhập sai',
                        text: 'Mời bạn nhập lại',
                    })
                    let arr = []
                    document.querySelector('#form-errors-create').innerHTML = `@include('screens.backend.questionquiz.components.layout.formerror')`
                    for (const key in res.response.data.errors) {
                        let elm = document.createElement('div')
                        arr.push(`<div>${key}: ${res.response.data.errors[key]}</div>`)
                    }
                    console.log(document.querySelector(`#show-errors`));
                    document.querySelector(`#show-errors`).innerHTML = arr.join('')
                }
            )
    }
</script>
