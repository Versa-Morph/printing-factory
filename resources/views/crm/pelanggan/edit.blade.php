@extends('layouts.app')

@section('style')
@endsection

@section('header-info-content')
@endsection
@section('content')
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">{{ $page_title }}</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <form class="form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom01">Nama Lengkap</label>
                                <input type="text" class="form-control" value="{{ $data->nama_pelanggan }}" name="nama_pelanggan"
                                    placeholder="Nama Lengkap Pelanggan">
                            </div>
                        </div><!-- end col -->
                    </div><!-- end row -->

                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom01">Email</label>
                                <input type="email" class="form-control" value="{{ $data->email }}" name="email" placeholder="Email Pelanggan">
                            </div>
                        </div><!-- end col -->
                    </div><!-- end row -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom01">Telepon</label>
                                <input type="number" class="form-control" value="{{ $data->telepon }}" name="telepon" placeholder="Telepon Pelanggan">
                            </div>
                        </div><!-- end col -->
                    </div><!-- end row -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom01">Alamat</label>
                                <textarea name="alamat" class="form-control" placeholder="Alamat Pelanggan">{{ $data->alamat }}</textarea>
                            </div>
                        </div><!-- end col -->
                    </div><!-- end row -->
                    <a href="{{ route('pelanggan-list') }}" class="btn btn-danger" style="float: left">Kembali</a>
                    <button type="submit" class="btn btn-primary" style="float: right">Simpan</button>
                </form><!-- end form -->
            </div><!-- end card body -->
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ajaxStart(function() {
            showLoading('Sedang memproses permintaan...');
        }).ajaxStop(function() {
            hideLoading();
        });
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('.form-data');

            form.addEventListener('submit', function(e) {
                e.preventDefault();

                // Clear previous validation messages
                const errorElements = document.querySelectorAll('.error-msg');
                errorElements.forEach(function(element) {
                    element.remove();
                });

                const nama = document.querySelector('input[name="nama_pelanggan"]').value.trim();
                const email = document.querySelector('input[name="email"]').value.trim();
                const telepon = document.querySelector('input[name="telepon"]').value.trim();
                const alamat = document.querySelector('textarea[name="alamat"]').value.trim();
                let isValid = true;

                if (!nama) {
                    showError('Nama Lengkap tidak boleh kosong', 'input[name="nama_pelanggan"]');
                    isValid = false;
                }

                if (!email) {
                    showError('Email tidak boleh kosong', 'input[name="email"]');
                    isValid = false;
                }

                if (!telepon) {
                    showError('Telepon tidak boleh kosong', 'input[name="telepon"]');
                    isValid = false;
                }

                if (!alamat) {
                    showError('Alamat tidak boleh kosong', 'textarea[name="alamat"]');
                    isValid = false;
                }

                if (isValid) {
                    const formData = new FormData(form);

                    $.ajax({
                        url: '{{ route('pelanggan-update',$data->id) }}',
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
                                window.location.href = '{{ route('pelanggan-list') }}';
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
