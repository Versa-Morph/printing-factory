@extends('layouts.app')
@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/role/src/plugins/css/light/editors/quill/quill.snow.css') }}">
<link href="{{ asset('assets/role/src/assets/css/light/apps/todolist.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/role/src/assets/css/light/components/modal.css') }}" rel="stylesheet" type="text/css">

<link rel="stylesheet" type="text/css" href="{{ asset('assets/role/src/plugins/css/dark/editors/quill/quill.snow.css') }}">
<link href="{{ asset('assets/role/src/assets/css/dark/apps/todolist.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/role/src/assets/css/dark/components/modal.css') }}" rel="stylesheet" type="text/css">
@endpush


@section('content')

<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">

        <div class="mail-box-container">
            <div class="mail-overlay"></div>
    
            <div class="tab-title">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-12 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shield"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                        <h5 class="app-title mt-2">ROLE LIST</h5>
                    </div>
                    <div class="col-md-12 col-sm-12 col-12 ps-0">
                        <div class="todoList-sidebar-scroll mt-4">
                            <ul class="nav nav-pills d-block roleList" id="pills-tab" role="tablist">
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-12">
                        <button class="btn btn-primary roles-add" type="button" data-bs-target="#tabs-add-role" id="addTask"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg> New Role</button>
                    </div>
                </div>
            </div>
    
            <div id="todo-inbox" class="accordion todo-inbox">
                <div class="search">
                    <input type="text" class="form-control input-search" placeholder="Search Task...">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu mail-menu d-lg-none"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
                </div>
    
                <div class="todo-box">
                    <div id="ct" class="todo-box-scroll">
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table id="">

                </table>
            </div>
        </div>
    </div>
</div>

<div id="modalContainer"></div>
@endsection
@push('scripts')
<script src="{{ asset('assets/role/src/plugins/src/editors/quill/quill.js') }}"></script>
<script src="{{ asset('assets/role/src/assets/js/apps/todoList.js') }}"></script>
<script>
    $(document).ready(function() {
        // getData
        

        // Event create by Modal
        $(document).on('click', '.roles-add', function() {
            var getTarget = $(this).data('bs-target');
            $.get("{{ route('roles.modal-add') }}", function(data) {
                $('#modalContainer').html(data);
                $(`${getTarget}`).modal('show');
            });
        });

        // Event Edit by Modal
        $(document).on('click', '.roles-edit-table', function() {
            var roleId = $(this).data('bs-target');
            var parts = roleId.split("-");
            var id = parseInt(parts[1]);

            $.get("{{ url('roles/modal-edit') }}/" + id, function(data) {
                $('#modalContainer').html(data);
                $(`${roleId}`).modal('show');
            });
        });

        // Event Delete by Modal
        $(document).on('click', '.roles-delete-table', function() {
            var roleId = $(this).data('bs-target');
            var parts = roleId.split("-");
            var id = parseInt(parts[1]);

            $.get("{{ url('roles/modal-delete') }}/" + id, function(data) {
                $('#modalContainer').html(data);
                $(`${roleId}`).modal('show');
            });
        });
    });
</script>
@endpush