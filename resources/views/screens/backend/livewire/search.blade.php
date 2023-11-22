<div>
    <div class="mb-1">
        List Questions:
    </div>
    <form>
        <div class="form-group">
            <input class="form-control" wire:model="search" type="text" placeholder="Search tag quiz..."/>
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
                    <input type="checkbox" value="{{$question->id}}" name="checkbox[]" >
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
