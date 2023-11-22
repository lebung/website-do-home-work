<script>
    /**
     * Lấy dữ liệu image
     * */
    var avatar4 = new KTImageInput('img_4');
    var avatar5 = new KTImageInput('kt_image_5');
    var avatar3 = new KTImageInput('img_3');
    var avatar2 = new KTImageInput('img_2');
    /**
     * sửa item cha
     * */
    function edit_course_category(item) {
        console.log(item);
        var name = document.getElementById('name_edit_courser');
        var id = document.getElementById('id');
        id.value = item.id
        name.value = item.name;
        var kt_image_5 = document.getElementById('kt_image_5');
        kt_image_5.style = 'background-image: url( http://127.0.0.1:8000/' + item.thumbnail+ ')'
    }
    /**
     * Lấy dữ liệu thêm item con
     * */
    function add_courseItem(item) {
        var parent_id = document.getElementById('parent_id');
        parent_id.value = item.id
    }
    /**
     * sửa item con
     * */
    function editItem(item) {
        console.log(item);
        var nameItem = document.getElementById('nameEditItem');
        var idItem = document.getElementById('idItem');
        idItem.value = item.id
        nameItem.value = item.name;
        var img_3 = document.getElementById('img_3');
        img_3.style = 'background-image: url( http://127.0.0.1:8000/' + item.thumbnail+ ')'
    }
    /**
     * ajax search
     * */
    $('#search').on('keyup', function() {
        $value = $(this).val();
        $.ajax({
            type: 'get',
            url: '{{ URL::to('/admin/course_category/search_course_category') }}',
            data: {
                'search': $value,
            },
            success: function(data) {
                console.log($value);
                $('.example-preview').html(data);
                if ($value == '') {
                    window.location.reload()
                }
            }
        });
    })
    $.ajaxSetup({
        headers: {
            'csrftoken': '{{ csrf_token() }}'
        }
    });
    function add_course_category(id_form,id_modal) {
        formData = new FormData(document.getElementById(id_form));
        console.log(formData)
        $.ajax({
            type: 'post',
            url: '{{ URL::to('/admin/course_category/store') }}',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                $('tbody').html(data);
                Swal.fire(
                    'Good job!',
                    'Thanh cong',
                    'success'
                )
                modal =document.querySelector('.modal-backdrop')
                modal.classList.remove('show');
                modal.style.display = 'none'
                modal1 =  document.getElementById(id_modal)
                modal1.classList.remove('show');
                modal1.style.display = 'none'
                window.location.reload()
            },
            error: function(response) {

                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: response.responseJSON.errors.name[0],
                    footer: '<a href="">Quay trở lại?</a>'
                })
            }
        });
        $.ajaxSetup({
            headers: {
                'csrftoken': '{{ csrf_token() }}'
            }
        });
    }

    function update_course_category(id_modal,id_form) {
        console.log(id_modal)
        formData = new FormData(document.getElementById(id_form));
        console.log(formData)
        $.ajax({
            type: 'post',
            url: '{{ URL::to('/admin/course_category/update') }}',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                $('tbody').html(data);
                Swal.fire(
                    'Good job!',
                    'Thanh cong',
                    'success'
                )
                modal = document.querySelector('.modal-backdrop')
                modal.classList.remove('show');
                modal.style.display = 'none'
                modal1 = document.getElementById(id_modal)
                modal1.classList.remove('show');
                modal1.style.display = 'none'
                window.location.reload()
            },
            error: function(response) {
                console.log(response.responseJSON.errors.name)
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: response.responseJSON.errors.name[0],
                    footer: '<a href="">Quay trở lại?</a>'
                })
            }
        });
        $.ajaxSetup({
            headers: {
                'csrftoken': '{{ csrf_token() }}'
            }
        });
    }


</script>
