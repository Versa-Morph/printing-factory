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
                                <select class="form-select mr-sm-2 @error('id_desain') is-invalid @enderror" id="id_desain" name="id_desain" style="width:100%">
                                    <option disabled selected>Pilih Desain Produk</option>
                                    @foreach ($desain_products as $desain_product)
                                    <option value="{{ $desain_product->id }}"
                                        {{ old('id_desain') == $desain_product->id ? 'selected' : '' }}>
                                        {{ $desain_product->nama_desain }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom01">Jumlah Produksi</label>
                                <input type="number" class="form-control" name="jumlah_produksi" placeholder="Ex:10..">
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
                                <label class="form-label" for="validationCustom01">Tanggal Mulai</label>
                                <input type="date" class="form-control" name="tanggal_mulai">
                            </div>
                        </div><!-- end col -->

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom01">Tanggal Selesai</label>
                                <input type="date" class="form-control" name="tanggal_selesai">
                            </div>
                        </div><!-- end col -->

                        <div class="col-md-4 mb-4">
                            <label class="col-form-label">Status Rencana</label>
                            <select class="form-select" name="status_rencana">
                                <option selected value="Aktif">Aktif</option>
                                <option value="Selesai">Selesai</option>
                            </select>
                        </div>
                    </div><!-- end row -->

                    <a href="{{ route('rencana-produksi-list') }}" class="btn btn-danger" style="float: left">Kembali</a>
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

                const jumlahProduksi = document.querySelector('input[name="jumlah_produksi"]').value.trim();
                const tanggalMulai = document.querySelector('input[name="tanggal_mulai"]').value.trim();
                const tanggalSelesai = document.querySelector('input[name="tanggal_selesai"]').value.trim();
                let isValid = true;

                if (!jumlahProduksi) {
                    showError('Jumlah Produksi tidak boleh kosong', 'input[name="jumlah_produksi"]');
                    isValid = false;
                }

                if (!tanggalMulai) {
                    showError('Tanggal Mulai tidak boleh kosong', 'input[name="tanggal_mulai"]');
                    isValid = false;

                }
                if (!tanggalSelesai) {
                    showError('Tanggal Selesai tidak boleh kosong', 'input[name="tanggal_selesai"]');
                    isValid = false;
                }

                if (isValid) {
                    const formData = new FormData(form);

                    $.ajax({
                        url: '{{ route('rencana-produksi-store') }}',
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
                                window.location.href = '{{ route('rencana-produksi-list') }}';
                            } else {
                                alertFiled(response.msg);
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
