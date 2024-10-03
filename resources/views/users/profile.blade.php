@extends('layouts.app')

@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

@endsection

@section('header-info-content')

@endsection
@section('content')
<div class="card br-20">
    <div class="card-body px-0">
        <div class="row">
            <div class="col-xl-3">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="user-profile-img">
                            <img src="{{ asset('assets/images/pattern-bg.jpg') }}"class="profile-img profile-foreground-img rounded-top" style="height: 120px;" alt="">
                            <div class="overlay-content rounded-top">
                                <div>
                                    <div class="user-nav p-3">
                                        <div class="d-flex justify-content-end">
                                            <div class="dropdown">
                                                <a class="dropdown-toggle" href="#" role="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bx bx-dots-horizontal font-size-20 text-white"></i>
                                                </a>

                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                                    <li><a class="dropdown-item" href="#">Another action</a>
                                                    </li>
                                                    <li><a class="dropdown-item" href="#">Something else
                                                            here</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end user-profile-img -->

                        <div class="mt-n5 position-relative">
                            <div class="text-center">
                                <img src="{{ $user->avatar ? asset('assets/img/users/' . $user->avatar) : asset('assets/img/users/user.jpg') }}" alt="" class="avatar-xl rounded-circle img-thumbnail">

                                <div class="mt-3">
                                    <h5 class="mb-1">{{ ($user->username ?? '') }}</h5>
                                    <div>
                                        <a href="#" class="badgebg-success-subtle text-success m-1">{{ $user->getRoleNames()[0] ?? '' }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="p-3 mt-3">
                            <div class="row text-center">
                                
                            </div>
                        </div>
                    </div>
                    <!-- end card body -->
                </div>
            </div>
            
            <div class="col-xl-9">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('profile-update',$user->id) }}" method="POST" enctype="multipart/form-data">
                            @method('patch')
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <h4 class="card-title mb-4">Edit Profile</h4>
                                    <!-- Last Name -->
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="Ex:david" id="username" name="username" value="{{ $user->username }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" placeholder="Ex:xxx@gmail.com" id="email" name="email" value="{{ $user->email }}">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="form-file" class="form-label">Image</label> <br>
                                        <img src="{{ asset('assets/images/user/'.($user->avatar ?? 'user.jpg')) }}" width="15%"height="15%" class=" mb-2 rounded-circle me-n2 card-hover border border-2 border-white">
                                        <input type="file" name="avatar" class="form-control" id="form-file">
                                    </div>
                                    <div class="small text-danger">*Kosongkan jika tidak mau diisi</div>
                                </div>

                                <div class="col-lg-6">
                                    <h4 class="card-title mb-4">Change Password</h4>
                                    <div class="form-group mb-3">
                                        <label for="password" class="form-label">Old Password</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="old_password" value="{{ old('password') }}" placeholder="Old Password">
                                    </div>

                                <div class="form-group">
                                    <label for="new_password" class="form-label">New Password</label>
                                    <input type="password" class="form-control @error('new_password') is-invalid @enderror" id="new_password" name="new_password" value="{{ old('new_password') }}" placeholder="New Password">
                                </div>
                                </div>
                            </div>

                            <div class="mt-2 text-end">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end card body -->
</div>

@endsection

@section('script')
<!-- jQuery and DataTables JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@endsection
