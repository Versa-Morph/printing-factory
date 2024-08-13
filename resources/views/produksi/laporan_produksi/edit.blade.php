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
                                <label class="form-label" for="validationCustom01">Jadwal Produksi</label>
                                <select name="id_jadwal" class="form-control select2" id="id_jadwal">
                                    <option value="">Pilih Jadwal Produksi</option>
                                    @foreach ($jadwal as $item)
                                        <option value="{{ $item->id }}" {{ $laporan->id_jadwal == $item->id ? 'selected' : '' }} >{{ $item->rencana->desain->nama_desain .' | '. $item->rencana->jumlah_produksi .' Produksi' .' | Tanggal : '.$item->tanggal_produksi}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div><!-- end col -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom01">Jumlah Produksi</label>
                                <input type="number" class="form-control" value="{{ $laporan->jumlah_produksi }}" name="jumlah_produksi">
                            </div>
                        </div><!-- end col -->

                    </div><!-- end row -->

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom01">Jumlah Reject</label>
                                <input type="number" class="form-control" value="{{ $laporan->jumlah_reject }}" name="jumlah_reject">
                            </div>
                        </div><!-- end col -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom01">Tanggal Laporan</label>
                                <input type="date" class="form-control" value="{{ $laporan->tanggal_laporan }}" name="tanggal_laporan">
                            </div>
                        </div><!-- end col -->
                    </div><!-- end row -->

                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom01">Keterangan</label>
                                <textarea name="keterangan" class="form-control" id="">{{ $laporan->keterangan }}</textarea>
                            </div>
                        </div>
                    </div><!-- end row -->
                    <a href="{{ route('laporan-produksi-list') }}" class="btn btn-danger" style="float: left">Kembali</a>
                    <button type="submit" class="btn btn-primary" style="float: right">Simpan</button>
                </form><!-- end form -->
            </div><!-- end card body -->
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ajaxStart(function() {
            showLoading('Processing Request.....');
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

                const id_jadwal = document.querySelector('select[name="id_jadwal"]').value.trim();
                const jumlah_produksi = document.querySelector('input[name="jumlah_produksi"]').value.trim();
                const jumlah_reject = document.querySelector('input[name="jumlah_reject"]').value.trim();
                const tanggal_laporan = document.querySelector('input[name="tanggal_laporan"]').value.trim();
                const keterangan = document.querySelector('textarea[name="keterangan"]').value.trim();
                let isValid = true;

                if (!id_jadwal) {
                    showError('Jadwal Produksi tidak boleh kosong', 'select[name="id_jadwal"]');
                    isValid = false;
                }

                if (!jumlah_produksi) {
                    showError('Jumlah Produksi tidak boleh kosong', 'input[name="jumlah_produksi"]');
                    isValid = false;
                }

                if (!jumlah_reject) {
                    showError('Jumlah Reject tidak boleh kosong', 'input[name="jumlah_reject"]');
                    isValid = false;
                }

                if (!tanggal_laporan) {
                    showError('Tanggal Laporan tidak boleh kosong', 'input[name="tanggal_laporan"]');
                    isValid = false;
                }

                if (!keterangan) {
                    showError('Keterangan tidak boleh kosong', 'textarea[name="keterangan"]');
                    isValid = false;
                }

                if (isValid) {
                    const formData = new FormData(form);

                    $.ajax({
                        url: '{{ route('laporan-produksi-update',$laporan->id) }}',
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
                                window.location.href = '{{ route('laporan-produksi-list') }}';
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
