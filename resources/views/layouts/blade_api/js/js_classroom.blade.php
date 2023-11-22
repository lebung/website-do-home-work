<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

<script>

    $('#search').on('keyup', function() {
        $value = $(this).val();
        $.ajax({
            type: 'get',
            url: '{{ URL::to('/admin/classroom/search_name') }}',
            data: {
                'search': $value
            },
            success: function(data) {
                $('tbody').html(data);
                if($value==''){
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

    $('#author').on('change', function() {
        $value = $(this).val();
        $.ajax({
            type: 'get',
            url: '{{ URL::to('/admin/classroom/fillter') }}',
            data: {
                'fillter': $value
            },
            success: function(data) {
                $('tbody').html(data);
                if($value==0 || $value==''){
                    window.location.reload()
                }

            }
        });
    })

    function change(item) {
        $value = item.id;
        $.ajax({
            type: 'get',
            url: '{{ URL::to('/admin/classroom/change_status') }}',
            data: {
                'change_status': $value
            },
            success: function(data) {
                $('tbody').html(data);
                Swal.fire(
                    'Good job!',
                    'Thanh cong',
                    'success'
                )


            }
        });

    }


    
</script>
