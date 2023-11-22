<div wire:ignore.self class="modal fade modal-edit-user" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Role</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Name Role</label>
                  <input type="text" wire:model="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                  @error('name') <span style="color: red" class="error">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">@foreach ($permission as $item)
                    {{$item}}
                @endforeach Add Permission</label>
                  <select class="form-control" wire:model="permission" multiple>
                      <optgroup label="Assign Permission">
                          @foreach ($permissions as $item)
                          <option value="{{$item->id}}">{{$item->name}}</option>
                          @endforeach
                      </optgroup>
                    </select>
                  @error('permission.*') <span class="error">{{ $message }}</span> @enderror
                </div>

              </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" wire:click.prevent="processRole()" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
  </div>
