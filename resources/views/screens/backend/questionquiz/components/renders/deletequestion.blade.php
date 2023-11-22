<script>
    function delete_question(elm, a) {
        Swal.fire({
            title: 'Bạn muốn xóa câu hỏi này?',
            text: "Bạn xóa xong sẽ mất luôn câu trả lời!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                let _url = '{{ route('question.destroyQuestion', ['id' => ':id']) }}'
                _url = _url.replace(':id', a)
                axios.delete(_url).then((data) => {
                    let a = elm.closest('#question-in-list');
                    document.querySelector('#list_questions').removeChild(a);
                })
            }
        })
    }
</script>
