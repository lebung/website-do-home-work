@extends('layouts.backend.master')

@section('title', 'Trang Quản Trị')
@section('title-heading', 'Role')
@section('content')
<div class="card card-custom">
    
    <form action="{{route('admin.role.post-role')}}" method="POST" class="form">
        @csrf
        @method('POST')
        <div class="card-body">
         <h3 class="font-size-lg text-dark font-weight-bold mb-6"> Role:</h3>
         <div class="mb-15">
          <div class="form-group row">
           <label class="col-lg-3 col-form-label">Name Role</label>
           <div class="col-lg-6">
            <input type="text" name="name" class="form-control" placeholder="Name Role"/>
            <span class="form-text text-muted">Please enter your full name</span>
           </div>
          </div>
          <div class="form-group row">
           <label class="col-lg-3 col-form-label">Add Permissions:</label>
           <div class="col-lg-6">
            
            <div class="form-group row">
                
                <div style="width: 100%;" class="col-sm-12">
                    <select class="form-control select2" id="kt_select2_3" name="permission[]" multiple="multiple">
                        <optgroup label="Assign Permission">
                            @foreach ($permissions as $permission)
                            <option value="{{$permission->id}}">{{$permission->name}}</option>
                            @endforeach
                        </optgroup>
                        
                    </select>
                </div>
            </div>
           </div>
          </div>
         </div>
       
        </div>
        <div class="card-footer">
         <div class="row">
          <div class="col-lg-3"></div>
          <div class="col-lg-6">
           <button type="submit" class="btn btn-success mr-2">Submit</button>
           <button type="reset" class="btn btn-secondary">Cancel</button>
          </div>
         </div>
        </div>
       </form>
</div>
@endsection

@section('custom-js-tag')
    <script>
        $(document).ready(function(){
            $('.select2').select2()
        })
    </script>
@endsection