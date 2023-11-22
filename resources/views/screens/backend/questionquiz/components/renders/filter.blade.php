<script>
    function replace_filter() {
        let _url = '{{ route('question.datalist', ['sort' => ':sort', 'title' => ':title']) }}';
        _url = _url.replace(':sort', obj_filter.sort)
        _url = _url.replace(':title', obj_filter.title)
        axios.get(_url)
            .then(
                (res) => {
                    document.querySelector('#table-main').innerHTML = res.data
                }
            )
            .catch(
                (error) => {
                    alert_error(error.message)
                }
            )
    }

    var obj_filter = {
        sort: 0,
        title: 0,
    };

    (() => {
        replace_filter()
    })();

    function search(elm) {
        obj_filter.title = elm.value == '' ? 0 : elm.value
        replace_filter()
    }

    function sortId(elm) {
        obj_filter.sort = elm.value
        replace_filter()
    }

    function paingation(page,total) {
        let _url = '/question/datalist/:sort/:title?page=' + page;
        _url = _url.replace(':sort', obj_filter.sort)
        _url = _url.replace(':title', obj_filter.title)
        axios.get(_url)
            .then(
                (res) => {
                    document.querySelector('#table-main').innerHTML = res.data
                }
            )
            .catch(
                (error) => {
                    alert_error(error.message)
                }
            )
    }

</script>
