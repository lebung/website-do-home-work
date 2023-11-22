<div wire:ignore.self class="modal fade modal-edit-user" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Role</h5>
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
                  <select class="form-control" aria-label="Default select example" wire:model="permission" multiple>
                      <optgroup label="Assign Permission">
                          @foreach ($permissions as $item)
                          <option value="{{$item->id}}">{{$item->name}}</option>
                          @endforeach
                      </optgroup>
                    </select>
                  @error('permission.*') <span class="error">{{ $message }}</span> @enderror

                 {{-- <div class="mb-3">
                    <div class="form-group row">
                        <label class="col-sm-12"> @foreach ($okok as $item)
                            {{$item}}
                        @endforeach Add Permission</label>
                        <div class="col-sm-12">
                            <select wire:model="okok" class="form-control select2" id="kt_select2_3" name="param" multiple="multiple">
                                <optgroup label="Choose Permission">
                                    @foreach ($permissions as $item)
                                        <option selected="selected" value="{{$item->id}}">{{$item->name}}</option>
                                        <option {{in_array($item->id,$rolePermissions) ? "selected" : ""}} value="{{$item->id}}">{{$item->name}}</option>

                                    @endforeach
                                </optgroup>

                                
                                
                                
                            </select>
                        </div> 
                        @error('permission.*') <span class="error">{{ $message }}</span> @enderror
                    </div> --}}
{{-- <option value="NV" selected="selected">Nevada</option> --}}

                  {{-- <label for="exampleInputEmail1" class="form-label">Add Permission</label>
                  <select class="form-control" wire:model="permission" multiple>
                      <optgroup label="Assign Permission">
                          @foreach ($permissions as $item)
                          <option value="{{$item->id}}">{{$item->name}}</option>
                          @endforeach
                      </optgroup>
                    </select> --}}
                  
                </div>

              </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" wire:click.prevent="saveEditRole()" class="btn btn-primary">Save Edit</button>
          </div>
        </div>
      </div>
  </div>


