@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header justify-content-between d-flex align-items-center">
                    <h4 class="card-title">{{ $page_title }}</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <!-- Roles will be dynamically loaded here -->
                            </div>
                            <div class="col-md-12 col-sm-12 col-12">
                                <button class="btn btn-primary roles-add" type="button" data-bs-target="#tabs-add-role" id="addTask">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus">
                                        <line x1="12" y1="5" x2="12" y2="19"></line>
                                        <line x1="5" y1="12" x2="19" y1="12"></line>
                                    </svg> New Role
                                </button>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="search mb-4">
                                <input type="text" class="form-control input-search" placeholder="Search Task...">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu mail-menu d-lg-none">
                                    <line x1="3" y1="12" x2="21" y2="12"></line>
                                    <line x1="3" y1="6" x2="21" y1="6"></line>
                                    <line x1="3" y1="18" x2="21" y2="18"></line>
                                </svg>
                            </div>
                            <div class="tab-content text-muted mt-4 mt-md-0" id="v-pills-tabContent">
                                <!-- Permissions will be dynamically loaded here -->
                            </div>
                        </div><!-- end col -->
                    </div><!-- end row -->
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->
    </div><!-- end row -->
<div id="modalContainer"></div>

@endsection

@section('script')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        fetchRolesAndPermissions();

        // Fetch Roles and Permissions Function
        function fetchRolesAndPermissions() {
            $.ajax({
                url: "{{ route('roles-get-data') }}",
                method: 'GET',
                success: function(response) {
                    if (response.roles && response.permissions) {
                        loadRoles(response.roles);
                    } else {
                        console.error('No roles or permissions found in response.');
                    }
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.error('Error fetching roles and permissions:', xhr.responseText);
                    alert('There was an error fetching data. Please try again later.');
                }
            });
        }

        // Load Roles into nav-pills
        function loadRoles(roles) {
            let rolesNav = $('#v-pills-tab');
            rolesNav.empty();
            roles.forEach(function(role) {
                rolesNav.append(`
                    <a class="nav-link mb-2" data-role-id="${role.id}" data-bs-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">
                        <i class="mdi mdi-chevron-right text-primary me-1"></i>${role.name}
                    </a>
                `);
            });

            // Add click event listener to load permissions
            $('#v-pills-tab a').on('click', function() {
                let roleId = $(this).data('role-id');
                fetchPermissions(roleId);
            });
        }

        // Fetch Permissions for a Role
        function fetchPermissions(roleId) {
            $.ajax({
                url: "{{ route('roles-get-permissions', '') }}/" + roleId,
                method: 'GET',
                success: function(response) {
                    if (response.permissions) {
                        loadRolePermissions(roleId, response.permissions);
                    } else {
                        console.error('No permissions found for role ID:', roleId);
                    }
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.error('Error fetching permissions for role ID ' + roleId + ':', xhr.responseText);
                    alert('There was an error fetching permissions. Please try again later.');
                }
            });
        }

        // Load Permissions into tab-content and Check Assigned Permissions
        function loadRolePermissions(roleId, rolePermissions) {
            let permissionsContainer = $('#v-pills-tabContent');
            permissionsContainer.empty();

            // Fetch all permissions and compare with rolePermissions
            $.ajax({
                url: "{{ route('roles-get-all') }}",
                method: 'GET',
                success: function(response) {
                    let allPermissions = response.permissions;

                    permissionsContainer.append(`
                        <div>
                            <input class="form-check-input" type="checkbox" id="select-all">
                            <label class="form-check-label" for="select-all">Select All</label>
                        </div>
                    `);

                    allPermissions.forEach(function(permission) {
                        let isChecked = rolePermissions.some(function(rolePermission) {
                            return rolePermission.id === permission.id;
                        });

                        permissionsContainer.append(`
                            <div>
                                <input class="form-check-input permission-checkbox" type="checkbox" id="permission-${permission.id}" ${isChecked ? 'checked' : ''}>
                                <label class="form-check-label" for="permission-${permission.id}">${permission.name}</label>
                            </div>
                        `);
                    });

                    // Select All functionality
                    $('#select-all').on('change', function() {
                        $('.permission-checkbox').prop('checked', this.checked);
                    });

                    // If all individual checkboxes are selected, mark the "Select All" checkbox as checked
                    $('.permission-checkbox').on('change', function() {
                        if ($('.permission-checkbox:checked').length === $('.permission-checkbox').length) {
                            $('#select-all').prop('checked', true);
                        } else {
                            $('#select-all').prop('checked', false);
                        }
                    });
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.error('Error fetching all permissions:', xhr.responseText);
                    alert('There was an error fetching permissions. Please try again later.');
                }
            });
        }

        // Event Handlers for Modals
        $(document).on('click', '.roles-add', function() {
            var getTarget = $(this).data('bs-target');
            $.get("{{ route('roles-modal-add') }}", function(data) {
                $('#modalContainer').html(data);
                $(`${getTarget}`).modal('show');
            });
        });

        $(document).on('click', '.roles-edit-table', function() {
            var roleId = $(this).data('bs-target');
            var parts = roleId.split("-");
            var id = parseInt(parts[1]);

            $.get("{{ url('roles/modal-edit') }}/" + id, function(data) {
                $('#modalContainer').html(data);
                $(`${roleId}`).modal('show');
            });
        });

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
@endsection
