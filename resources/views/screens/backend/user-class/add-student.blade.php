@extends('layouts.backend.master')

@section('title', 'Thêm Khóa Học')

@section('title-heading', 'Thêm Khóa Học')

@section('content')
<div class="row">
    <div class="col-md-12" >
        @if (session()->has('error'))
            <div class="alert alert-danger text-center">{{ session()->get('error') }}</div>
        @endif
        @if (session()->has('warning'))
            <div class="alert alert-warning text-center">{{ session()->get('warning') }}</div>
        @endif
        @if (session()->has('success'))
            <div class="alert alert-success text-center">{{ session()->get('success') }}</div>
        @endif
        @error('addstudent')
        <div class="alert alert-danger text-center">{{ $message }}</div>    
        @enderror
        <form action="" method="POST" class="col-lg-12" >
            @csrf
            @method('POST')
            <div class="card card-custom card-stretch gutter-b example example-compact">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">Add Student</h3>
                    </div>
                    <div class="card-toolbar">
                        <button  type="submit" class="btn btn-primary">Add Student</button>
                    </div>
                </div>
                <div class="card-body">
                    <select name="addstudent[]" class="dual-listbox" multiple="multiple" data-available-title="Source Options" data-selected-title="Destination Options" data-add="&lt;i class='flaticon2-next'&gt;&lt;/i&gt;" data-remove="&lt;i class='flaticon2-back'&gt;&lt;/i&gt;" data-add-all="&lt;i class='flaticon2-fast-next'&gt;&lt;/i&gt;" data-remove-all="&lt;i class='flaticon2-fast-back'&gt;&lt;/i&gt;">
                        @foreach ($users as $user)
                            <option value="{{$user->id}}">{{$user->email}}</option>    
                        @endforeach
                        {{-- <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                        <option value="4">Four</option>
                        <option value="5">Five</option>
                        <option value="6">Six</option>
                        <option value="7">Seven</option>
                        <option value="8">Eight</option>
                        <option value="9">Nine</option>
                        <option value="10">Ten</option> --}}
                    </select>

                </div>
               
            </div>
        </form>
        
</div>
@endsection

@section('custom-js-tag')
<script src="https://cdn.jsdelivr.net/npm/dual-listbox/dist/dual-listbox.min.js"></script>


<!-- for pinned version -->
{{-- <script src="https://cdn.jsdelivr.net/npm/dual-listbox@1.0.9/dist/dual-listbox.min.js"></script> --}}
<script>
    // Class definition
var KTDualListbox = function() {
    // Private functions
    var initDualListbox = function() {
        // Dual Listbox
        var listBoxes = $(".dual-listbox");

        listBoxes.each(function() {
            var $this = listBoxes
            // get titles
            var availableTitle = ($this.attr("data-available-title") != null) ? $this.attr("data-available-title") : "Available options";
            var selectedTitle = ($this.attr("data-selected-title") != null) ? $this.attr("data-selected-title") : "Selected options";

            // get button labels
            var addLabel = ($this.attr("data-add") != null) ? $this.attr("data-add") : "Add";
            var removeLabel = ($this.attr("data-remove") != null) ? $this.attr("data-remove") : "Remove";
            var addAllLabel = ($this.attr("data-add-all") != null) ? $this.attr("data-add-all") : "Add All";
            var removeAllLabel = ($this.attr("data-remove-all") != null) ? $this.attr("data-remove-all") : "Remove All";

            // get options
            var options = [];
            $this.children("option").each(function() {
                var value = $(this).val();
                var label = $(this).text();
                options.push({
                    text: label,
                    value: value
                });
            });

            // get search option
            var search = ($this.attr("data-search") != null) ? $this.attr("data-search") : "";
            // console.log($this.get(0))
            // init dual listbox
            var dualListBox = new DualListbox($this.get(0), {
                addEvent: function(value) {
                    console.log(value);
                },
                removeEvent: function(value) {
                    console.log(value);
                },
                availableTitle: availableTitle,
                selectedTitle: selectedTitle,
                addButtonText: addLabel,
                removeButtonText: removeLabel,
                addAllButtonText: addAllLabel,
                removeAllButtonText: removeAllLabel,
                // options: options,
            });

            if (search == "false") {
                dualListBox.search.classList.add("dual-listbox__search--hidden");
            }
        });
    };

    return {
        // public functions
        init: function() {
            initDualListbox();
        },
    };
}();

jQuery(document).ready(function() {
    KTDualListbox.init();
});
</script>
@endsection