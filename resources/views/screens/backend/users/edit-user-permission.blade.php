<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Name User</label>
              <input type="email" disabled value="{{$user->name}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
             
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Edit Role</label>
              <select class="form-control" aria-label="Default select example">
                {{-- <option selected>Open this select menu</option> --}}
                @foreach ($roles as $key => $role)
                    <option
                    {{$userRole == $role ? "selected" : ""}}
                     value="{{$key}}">{{$role}}
                    </option>    
                @endforeach
              </select>
            </div>
            
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
      </div>
    </div>
  </div>