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
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom01">Nama Desain</label>
                                <input type="text" class="form-control" name="nama_desain" placeholder="Ex:desain..">
                            </div>
                        </div><!-- end col -->
                        <div class="col-md-4">
                            <div class="form-group mb-3 text-left">
                                <label for="file_desain">File Desain</label>
                                <input type="file" class="form-control file-upload-input" name="file_desain" aria-label="file_desain" id="file_desain">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom01">Tanggal Buat</label>
                                <input type="date" class="form-control" name="tanggal_buat">
                            </div>
                        </div><!-- end col -->

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom01">Deskripsi</label>
                                <textarea name="deskripsi" class="form-control" placeholder="Ex:..."></textarea>
                            </div>
                        </div><!-- end col -->
                    </div><!-- end row -->

                    <a href="{{ route('desain-product-list') }}" class="btn btn-danger" style="float: left">Kembali</a>
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

                const namaDesain = document.querySelector('input[name="nama_desain"]').value.trim();
                const fileDesain = document.querySelector('input[name="file_desain"]').value.trim();
                const tanggalBuat = document.querySelector('input[name="tanggal_buat"]').value.trim();

                let isValid = true;

                if (!namaDesain) {
                    showError('Nama Desain tidak boleh kosong', 'input[name="nama_desain"]');
                    isValid = false;
                }

                if (!fileDesain) {
                    showError('File Desain tidak boleh kosong', 'input[name="file_desain"]');
                    isValid = false;
                }

                if (!tanggalBuat) {
                    showError('Tanggal Buat tidak boleh kosong', 'input[name="tanggal_buat"]');
                    isValid = false;
                }

                if (isValid) {
                    const formData = new FormData(form);

                    $.ajax({
                        url: '{{ route('desain-product-store') }}',
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
                                window.location.href = '{{ route('desain-product-list') }}';
                            } else {
                                console.log(response.msg);
                                // alertFailed(response.msg);
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
