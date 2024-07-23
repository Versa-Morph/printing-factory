@extends('layouts.app')


@section('header-info-content')
    <div class="collapse show verti-dash-content" id="dashtoggle">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 sub-title">Vertical</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0 ">
                                <li class="breadcrumb-item page-head"><a href="javascript: void(0);">layouts</a></li>
                                <li class="breadcrumb-item page-head active">Vertical</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card dash-header-box shadow-none border-0">
                        <div class="card-body p-0">
                            <div class="row row-cols-xxl-6 row-cols-md-3 row-cols-1 g-0">
                                <div class="col">
                                    <div class="mt-md-0 py-3 px-4 mx-2">
                                        <p class="text-white-50 mb-2 text-truncate">Campaign Sent </p>
                                        <h3 class="text-white mb-0">197</h3>
                                    </div>
                                </div><!-- end col -->

                                <div class="col">
                                    <div class="mt-3 mt-md-0 py-3 px-4 mx-2">
                                        <p class="text-white-50 mb-2 text-truncate">Annual Profit</p>
                                        <h3 class="text-white mb-0">$489.4k</h3>
                                    </div>
                                </div><!-- end col -->

                                <div class="col">
                                    <div class="mt-3 mt-md-0 py-3 px-4 mx-2">
                                        <p class="text-white-50 mb-2 text-truncate">Lead Coversation</p>
                                        <h3 class="text-white mb-0">32.89%</h3>
                                    </div>
                                </div><!-- end col -->

                                <div class="col">
                                    <div class="mt-3 mt-md-0 py-3 px-4 mx-2">
                                        <p class="text-white-50 mb-2 text-truncate">Sales Forecast</p>
                                        <h3 class="text-white mb-0">75.35%</h3>
                                    </div>
                                </div><!-- end col -->

                                <div class="col">
                                    <div class="mt-3 mt-lg-0 py-3 px-4 mx-2">
                                        <p class="text-white-50 mb-2 text-truncate">Daily Average Income</p>
                                        <h3 class="text-white mb-0">$1,596.5</h3>
                                    </div>
                                </div><!-- end col -->

                                <div class="col">
                                    <div class="mt-3 mt-lg-0 py-3 px-4 mx-2">
                                        <p class="text-white-50 mb-2 text-truncate">Annual Deals</p>
                                        <h3 class="text-white mb-0">2,659</h3>
                                    </div>
                                </div><!-- end col -->

                            </div><!-- end row -->
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="card">
        <div class="card-header">Manage Roles</div>
        <div class="card-body">
            @can('create-role')
                <a href="{{ route('roles.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> Add
                    New Role</a>
            @endcan
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">S#</th>
                        <th scope="col">Name</th>
                        <th scope="col" style="width: 250px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($roles as $role)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $role->name }}</td>
                            <td>
                                <form action="{{ route('roles.destroy', $role->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')

                                    <a href="{{ route('roles.show', $role->id) }}" class="btn btn-warning btn-sm"><i
                                            class="bi bi-eye"></i> Show</a>

                                    @if ($role->name != 'Super Admin')
                                        @can('edit-role')
                                            <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-primary btn-sm"><i
                                                    class="bi bi-pencil-square"></i> Edit</a>
                                        @endcan

                                        @can('delete-role')
                                            @if ($role->name != Auth::user()->hasRole($role->name))
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Do you want to delete this role?');"><i
                                                        class="bi bi-trash"></i> Delete</button>
                                            @endif
                                        @endcan
                                    @endif

                                </form>
                            </td>
                        </tr>
                    @empty
                        <td colspan="3">
                            <span class="text-danger">
                                <strong>No Role Found!</strong>
                            </span>
                        </td>
                    @endforelse
                </tbody>
            </table>

            {{ $roles->links() }}

        </div>
    </div>
@endsection
