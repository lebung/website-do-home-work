<div>
    <div class="row align-items-center mb-5">
        <div class="col-lg-12 col-xl-12">
            <div class="row align-items-center">
                <div class="col-md-6 my-2 my-md-0">
                    <form action="">
                        <div class="input-icon">
                            <input wire:model="searchUser" type="text" class="form-control" placeholder="Search..."
                                   id="kt_datatable_search_query">
                            <span>
                                <i class="flaticon2-search-1 text-muted"></i>
                            </span>
                        </div>
                    </form>
                </div>
                <div class="col-md-12 my-2">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <td></td>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Avatar</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $key => $user)
                            <tr>
                                <td><input type="checkbox" value="{{$user->id}}" name="checkbox[]"></td>
                                <td>{{++$key}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td><img width="100px" height="100px" src="{{asset($user->avatar)}}" alt=""></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
