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
                                <label class="form-label" for="validationCustom01">Rencana Produksi</label>
                                <select name="id_rencana" class="form-control select2" id="id_rencana">
                                    <option value="">Pilih Rencana Produksi</option>
                                    @foreach ($rencana as $item)
                                        <option value="{{ $item->id }}" {{ $jadwal->id_rencana == $item->id ? 'selected' : '' }}>{{ $item->desain->nama_desain .' | '. $item->jumlah_produksi .' Produksi' .' | '.$item->tanggal_mulai .' - '.$item->tanggal_selesai }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div><!-- end col -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom01">Tanggal Produksi</label>
                                <input type="date" class="form-control" value="{{ $jadwal->tanggal_produksi }}" name="tanggal_produksi">
                            </div>
                        </div><!-- end col -->

                    </div><!-- end row -->
                    <a href="{{ route('jadwal-produksi-list') }}" class="btn btn-danger" style="float: left">Kembali</a>
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

                const id_rencana = document.querySelector('select[name="id_rencana"]').value.trim();
                const tanggal_produksi = document.querySelector('input[name="tanggal_produksi"]').value.trim();
                let isValid = true;

                if (!id_rencana) {
                    showError('Rencana Produksi tidak boleh kosong', 'select[name="id_rencana"]');
                    isValid = false;
                }

                if (!tanggal_produksi) {
                    showError('Tanggal Produksi tidak boleh kosong', 'input[name="tanggal_produksi"]');
                    isValid = false;
                }

                if (isValid) {
                    const formData = new FormData(form);

                    $.ajax({
                        url: '{{ route('jadwal-produksi-update',$jadwal->id) }}',
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
                                window.location.href = '{{ route('jadwal-produksi-list') }}';
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
