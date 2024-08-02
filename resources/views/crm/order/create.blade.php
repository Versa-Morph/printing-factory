@extends('layouts.app')

@section('style')
@endsection

@section('header-info-content')
@endsection
@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">{{ $page_title }}</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <form class="form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom01">Pelanggan</label>
                                <select name="id_pelanggan" class="form-control select2" id="id_pelanggan">
                                    <option value="">Pilih Pelanggan</option>
                                    @foreach ($pelanggan as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_pelanggan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div><!-- end col -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom01">Tanggal Order</label>
                                <input type="date" class="form-control" name="tanggal_order">
                            </div>
                        </div><!-- end col -->

                    </div><!-- end row -->

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom01">Total Harga</label>
                                <input type="integer" class="form-control" name="total_harga">
                            </div>
                        </div><!-- end col -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom01">Status Order</label>
                                <select name="status_order" class="form-control" id="status_order">
                                    <option value="">Pilih Status</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Dalam Proses">Dalam Proses</option>
                                    <option value="Selesai">Selesai</option>
                                </select>
                            </div>
                        </div><!-- end col -->
                    </div><!-- end row -->
                    <a href="{{ route('order-list') }}" class="btn btn-danger" style="float: left">Kembali</a>
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

                const id_pelanggan = document.querySelector('select[name="id_pelanggan"]').value.trim();
                const tanggal_order = document.querySelector('input[name="tanggal_order"]').value.trim();
                const total_harga = document.querySelector('input[name="total_harga"]').value.trim();
                const status_order = document.querySelector('select[name="status_order"]').value.trim();
                let isValid = true;

                if (!id_pelanggan) {
                    showError('Pelanggan tidak boleh kosong', 'select[name="id_pelanggan"]');
                    isValid = false;
                }

                if (!tanggal_order) {
                    showError('Tanggal Order tidak boleh kosong', 'input[name="tanggal_order"]');
                    isValid = false;
                }

                if (!total_harga) {
                    showError('Total Harga tidak boleh kosong', 'input[name="total_harga"]');
                    isValid = false;
                }

                if (!status_order) {
                    showError('Status Order tidak boleh kosong', 'select[name="status_order"]');
                    isValid = false;
                }

                if (isValid) {
                    const formData = new FormData(form);

                    $.ajax({
                        url: '{{ route('order-store') }}',
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
                                window.location.href = '{{ route('order-list') }}';
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
