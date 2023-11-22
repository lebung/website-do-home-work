<div>
    <form action="">
        <div class="form-group">
            <input class="form-control search-tag-quiz" wire:model="searchTitle" type="text" placeholder="Search tag quiz..."/>
        </div>
    </form>
    <table class="table table-bordered" id="datatable">
        <thead>
        <tr>
            <th></th>
            <th>ID</th>
            <th>Title</th>
            <th>Tag</th>
        </tr>
        </thead>
        <tbody>
        @foreach($questions as $question)
            <tr>
                <td>
                    <input type="checkbox"
                           @foreach($quiz->questions as $ques)
                               @if($ques->id == $question->id)
                                   checked
                           @endif
                           @endforeach
                           name="checkbox[]" value="{{$question->id}}">
                </td>
                <td>
                    {{$question->id}}
                </td>
                <td>
                    {{$question->title}}
                </td>
                <td>
                    {{$question->tag}}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
