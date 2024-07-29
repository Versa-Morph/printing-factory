@extends('layouts.app')

@section('header-info-content')
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form class="form-data">
                @csrf
                <div class="form-group mb-3">
                    <label for="id_karyawan">Nama Karyawan</label>
                    <select class="form-control" id="id_karyawan" name="id_karyawan">
                        <option value="">-- Pilih Karyawan --</option>
                        @foreach ($karyawan as $kar)
                            <option value="{{ $kar->id }}">{{ $kar->nama_karyawan }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="jumlah_gaji">Jumlah Gaji</label>
                    <input type="text" class="form-control" id="jumlah_gaji" name="jumlah_gaji" readonly>
                </div>

                <div class="form-group mb-3">
                    <label for="tanggal_gaji">Tanggal Gaji</label>
                    <input type="date" class="form-control" id="tanggal_gaji" name="tanggal_gaji">
                </div>

                <div class="form-group mb-3">
                    <label for="keterangan">Keterangan</label>
                    <textarea class="form-control" id="keterangan" name="keterangan"></textarea>
                </div>

                <button type="submit" class="btn btn-primary" style="float: right">Simpan</button>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('#id_karyawan').change(function() {
                var karyawanId = $(this).val();
                if (karyawanId) {
                    $.ajax({
                        url: '{{ url('gaji/get-data-karyawan') }}' + '/' + karyawanId,
                        type: 'GET',
                        success: function(data) {
                            console.log(data);
                            $('#jumlah_gaji').val(data.jumlah_gaji);
                        }
                    });
                } else {
                    $('#jumlah_gaji').val('');
                }
            });
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

                const karyawan = document.querySelector('select[name="id_karyawan"]').value.trim();
                const jumlah_gaji = document.querySelector('input[name="jumlah_gaji"]').value.trim();
                const tanggal_gaji = document.querySelector('input[name="tanggal_gaji"]').value.trim();
                const keterangan = document.querySelector('textarea[name="keterangan"]').value.trim();
                let isValid = true;

                if (!karyawan) {
                    showError('Karyawan tidak boleh kosong', 'select[name="id_karyawan"]');
                    isValid = false;
                }

                if (!jumlah_gaji) {
                    showError('Jumlah gaji tidak boleh kosong', 'input[name="jumlah_gaji"]');
                    isValid = false;
                }

                if (!tanggal_gaji) {
                    showError('Tanggal Gaji tidak boleh kosong', 'input[name="tanggal_gaji"]');
                    isValid = false;
                }
                if (!keterangan) {
                    showError('Keterangan tidak boleh kosong', 'textarea[name="keterangan"]');
                    isValid = false;
                }

                if (isValid) {
                    const formData = new FormData(form);

                    $.ajax({
                        url: '{{ route('gaji-store') }}',
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
                                window.location.href = '{{ route('gaji-list') }}';
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
                if (element) {
                    const error = document.createElement('span');
                    error.className = 'error-msg text-danger';
                    error.textContent = message;
                    element.parentNode.appendChild(error);
                } else {
                    console.error(`Selector ${selector} not found.`);
                }
            }
        });
    </script>
@endsection
