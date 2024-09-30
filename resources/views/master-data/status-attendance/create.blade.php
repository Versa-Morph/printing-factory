@extends('layouts.app')

@section('style')
@endsection

@section('header-info-content')
@endsection
@section('content')
    <style>
        .heading-card-text {
            font-weight: bold;
            color: white;
            margin-top: 10px;
        }

        .background-polimer {
            background: #776acf;
        }

        #map {
            width: 100%;
            height: 400px;
        }
    </style>

    <div class="col-lg-12 mx-auto">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">{{ $page_title }}</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <form class="form-data">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header background-polimer">
                                    <h5 class="heading-card-text">Information</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Title<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="title" name="title"
                                            value="{{ old('title') }}" placeholder="Ex:Office 1..">
                                    </div>
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Address</label>
                                        <textarea name="address" class="form-control" placeholder="Ex:..."></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header background-polimer">
                                    <h5 class="heading-card-text">Location</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <a class="btn btn-primary btn-set"><i class="fas fa-map-marker-alt"></i>Set
                                            Current
                                            location</a>
                                    </div>
                                    <div class="mb-3">
                                        <label for="latitude" class="form-label">Latitude</label>
                                        <input type="text" class="form-control" id="latitude" name="latitude"
                                            value="{{ old('latitude') }}" placeholder="Ex:..">
                                    </div>
                                    <div class="mb-3">
                                        <label for="longitude" class="form-label">Longitude</label>
                                        <input type="text" class="form-control" id="longitude" name="longitude"
                                            value="{{ old('longitude') }}" placeholder="Ex:..">
                                    </div>
                                    <div class="mb-3">
                                        <label for="radius" class="form-label">Radius</label>
                                        <input type="number" class="form-control" id="radius" name="radius"
                                            value="{{ old('radius') }}" placeholder="Ex:..">
                                    </div>

                                    <div class="mb-3">
                                        <label for="" class="form-label" required>Blocking Location<span
                                                class="text-danger">*</span></label>
                                        <select name="status" id="" class="form-control">
                                            <option value="" disabled>Choose Status</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- end row -->

                    <a href="{{ route('shift-list') }}" class="btn btn-danger" style="float: left">Kembali</a>
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

                const title = document.querySelector('input[name="title"]').value.trim();
                const status = document.querySelector('select[name="status"]').value.trim();
                let isValid = true;

                if (!title) {
                    showError('Title is required', 'input[name="title"]');
                    isValid = false;
                }

                if (!status) {
                    showError('Please select an status', 'select[name="status"]');
                    isValid = false;
                }

                if (isValid) {
                    const formData = new FormData(form);

                    $.ajax({
                        url: '{{ route('status-attendance-store') }}',
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
                                window.location.href = '{{ route('status-attendance-list') }}';
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
    <script>
        document.querySelector('.btn-set').addEventListener('click', function() {
            // Mengecek apakah browser mendukung Geolocation
            if (navigator.geolocation) {
                // Mengecek status izin lokasi
                navigator.permissions.query({
                    name: 'geolocation'
                }).then(function(result) {
                    if (result.state === 'granted') {
                        // Jika izin sudah diberikan, langsung dapatkan lokasi
                        navigator.geolocation.getCurrentPosition(successCallback, showError);
                    } else if (result.state === 'prompt') {
                        // Jika izin belum diberikan, minta pengguna untuk memberikan izin
                        navigator.geolocation.getCurrentPosition(successCallback, showError);
                    } else {
                        // Jika izin ditolak, tampilkan SweetAlert untuk meminta pengguna mengaktifkan izin
                        Swal.fire({
                            title: 'Location Permission Needed',
                            text: 'Please enable location permissions to use this feature.',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Enable Permissions',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Jika pengguna mengkonfirmasi, coba lagi meminta izin lokasi
                                navigator.geolocation.getCurrentPosition(successCallback,
                                    showError);
                            }
                        });
                    }
                });
            } else {
                // Jika browser tidak mendukung Geolocation
                Swal.fire('Geolocation is not supported by this browser.');
            }
        });

        // Callback ketika lokasi berhasil didapatkan
        function successCallback(position) {
            const lat = position.coords.latitude; // Mengakses latitude
            const lng = position.coords.longitude; // Mengakses longitude

            // Set nilai input latitude dan longitude
            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;

            Swal.fire({
                title: 'Location Set!',
                text: `Latitude: ${lat}, Longitude: ${lng}`,
                icon: 'success',
            });
        }

        // Fungsi untuk menangani error ketika gagal mendapatkan lokasi
        function showError(error) {
            let errorMessage = '';

            switch (error.code) {
                case error.PERMISSION_DENIED:
                    errorMessage = 'User denied the request for Geolocation.';
                    break;
                case error.POSITION_UNAVAILABLE:
                    errorMessage = 'Location information is unavailable.';
                    break;
                case error.TIMEOUT:
                    errorMessage = 'The request to get user location timed out.';
                    break;
                case error.UNKNOWN_ERROR:
                    errorMessage = 'An unknown error occurred.';
                    break;
            }

            Swal.fire({
                title: 'Error',
                text: errorMessage,
                icon: 'error',
            });
        }
    </script>
@endsection
