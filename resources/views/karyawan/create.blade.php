@extends('layouts.app')

@section('style')
@endsection

@section('header-info-content')
@endsection
@section('content')
    <div class="col-lg-12 mx-auto">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">{{ $page_title }}</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <form class="form-data">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3"style="text-align: left">
                                <label class="form-label">User</label>
                                <select class="form-select mr-sm-2 @error('user_id') is-invalid @enderror" id="user_id" name="user_id" style="width:100%">
                                    <option disabled selected>Choose User</option>
                                    @foreach ($users as $user)
                                    <option value="{{ $user->id }}"
                                        {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom01">Nama Karyawan</label>
                                <input type="text" class="form-control" name="nama_karyawan" placeholder="Ex:David..">
                            </div>
                        </div><!-- end col -->

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom01">Jabatan</label>
                                <input type="text" class="form-control" name="jabatan" placeholder="Ex:Supervisor">
                            </div>
                        </div><!-- end col -->

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom01">Gaji</label>
                                <input type="number" class="form-control" name="gaji" placeholder="Ex:4.000.000">
                            </div>
                        </div><!-- end col -->

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom01">Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Ex:xxxx@gmail.com">
                            </div>
                        </div><!-- end col -->

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom01">No Telepon</label>
                                <input type="text" class="form-control" name="no_telepon" placeholder="Ex:08xxxxxxx">
                            </div>
                        </div><!-- end col -->

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom01">Alamat</label>
                                <textarea name="alamat" class="form-control" placeholder="Ex:Jakarta..."></textarea>
                            </div>
                        </div><!-- end col -->

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom01">Tanggal Lahir</label>
                                <input type="date" class="form-control" name="tanggal_lahir">
                            </div>
                        </div><!-- end col -->

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom01">Tanggal Masuk</label>
                                <input type="date" class="form-control" name="tanggal_masuk">
                            </div>
                        </div><!-- end col -->

                        <div class="col-md-4 mb-4">
                            <label class="col-md-2 col-form-label">Status</label>
                            <select class="form-select" name="status">
                                <option selected value="Aktif">Aktif</option>
                                <option value="Tidak Aktif">Tidak Aktif</option>
                            </select>
                        </div>
                    </div><!-- end row -->

                    <a href="{{ route('karyawan-list') }}" class="btn btn-danger" style="float: left">Kembali</a>
                    <button type="submit" class="btn btn-primary" style="float: right">Simpan</button>
                </form><!-- end form -->
            </div><!-- end card body -->
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('.form-data');

            form.addEventListener('submit', function(e) {
                e.preventDefault();

                // Clear previous validation messages
                const errorElements = document.querySelectorAll('.error-msg');
                errorElements.forEach(function(element) {
                    element.remove();
                });

                const jabatan = document.querySelector('input[name="jabatan"]').value.trim();
                const gaji = document.querySelector('input[name="gaji"]').value.trim();
                const email = document.querySelector('input[name="email"]').value.trim();
                const noTelepon = document.querySelector('input[name="no_telepon"]').value.trim();
                const alamat = document.querySelector('textarea[name="alamat"]').value.trim();
                const tanggalLahir = document.querySelector('input[name="tanggal_lahir"]').value.trim();
                const tanggalMasuk = document.querySelector('input[name="tanggal_masuk"]').value.trim();
                let isValid = true;

                if (!jabatan) {
                    showError('Jabatan tidak boleh kosong', 'input[name="jabatan"]');
                    isValid = false;
                }

                if (!gaji) {
                    showError('Gaji tidak boleh kosong', 'input[name="gaji"]');
                    isValid = false;
                }

                if (!email) {
                    showError('Email tidak boleh kosong', 'textarea[name="email"]');
                    isValid = false;
                }

                if (!noTelepon) {
                    showError('No Telepon tidak boleh kosong', 'textarea[name="no_telepon"]');
                    isValid = false;
                }

                if (!alamat) {
                    showError('Alamat tidak boleh kosong', 'textarea[name="alamat"]');
                    isValid = false;
                }
                if (!tanggalLahir) {
                    showError('Tanggal Lahir tidak boleh kosong', 'textarea[name="tanggal_lahir"]');
                    isValid = false;
                }

                if (!tanggalMasuk) {
                    showError('Tanggal Masuk tidak boleh kosong', 'textarea[name="tanggal_masuk"]');
                    isValid = false;
                }

                if (isValid) {
                    const formData = new FormData(form);

                    $.ajax({
                        url: '{{ route('karyawan-store') }}',
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success) {
                                alertSuccess(response.msg);
                                window.location.href = '{{ route('karyawan-list') }}';
                            } else {
                                alertFailed(response.msg);
                            }
                        },
                        error: function(xhr) {
                            const errors = xhr.responseJSON.errors;
                            for (const key in errors) {
                                if (errors.hasOwnProperty(key)) {
                                    showError(errors[key][0], `[name="${key}"]`);
                                }
                            }
                        }
                    });
                }
            });

            function showError(message, selector) {
                const element = document.querySelector(selector);
                const error = document.createElement('span');
                error.className = 'error-msg text-danger';
                error.textContent = message;
                element.parentNode.appendChild(error);
            }
        });
    </script>
@endsection
