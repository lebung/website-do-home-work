@extends('layouts.backend.master')

@section('title', 'Liên hệ')

@section('title-heading', 'User')

@section('content')

@livewire('admin.user-component', ['users' => $users])
  
  <!-- Modal -->
  {{-- <div class="modal fade modal-edit-user" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Email address</label>
                  <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                  <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Password</label>
                  <input type="password" class="form-control" id="exampleInputPassword1">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
  </div> --}}
@endsection

@section('custom-js-tag')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  window.addEventListener('alert',function(e) {
      Swal.fire({
          title:  e.detail.title,
          icon: e.detail.icon,
          iconColor: e.detail.iconColor,
          timer: 3000,
          toast: true,
          position: 'top-right',
          toast:  true,
          showConfirmButton:  false,
      });
  });
</script>
@endsection