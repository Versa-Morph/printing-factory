@extends('pwa.layouts.app')

@section('style-pwa')
    <style>
        .bg-category {
            background: #d9d9d9 !important;
        }
    </style>
@endsection

@section('content-pwa')
    <style>
        video {
            width: 300px;
            height: 200px !important;
        }

        #my_camera {
            width: 300px;
            height: 200px !important;
        }
    </style>
    <section id="homescreen">
        <div class="home-first-sec mt-32">
            <div class="container">
                <div class="home-first-sec-wrap">
                    <h1>Hey, {{ Auth::user()->name }}</h1>
                    <p class="mt-8">Welcome, please be present on time and work spirit!</p>
                </div>
                <div class="serachbar-homepage2 mt-24">
                    <h6 id="date_day"></h6>
                    <h4 class="font-weight-bold" id="clock"></h4>

                </div>
            </div>
        </div>
        <form action="{{ route('pwa-store-attend') }}" method="post" class="form" enctype="multipart/form-data">
            @csrf
            <section id="categories-section">
                <div class="container">
                    <div class=" d-flex align-items-center flex-column">
                        <div class="home-first-sec-wrap">
                            <h4 class="font-weight-bold" id="clock"></h4>
                        </div>

                        <div id="my_camera"></div>
                        <div id="results"></div>
                        <div class="d-flex mt-2 gap-2">
                            <button id="take_in" type="button" class="btn btn-primary btn-block btn-sm">Take
                                Foto</button>
                            <button id="ulangi" type="button" class="btn btn-secondary btn-sm">Change
                                Foto</button>
                        </div>
                        <input type="hidden" name="image" class="image-absen">
                        <input type="hidden" name="latitude" id="lat" class="latitude">
                        <input type="hidden" name="longitude"id="long" class="longitude">
                        <input type="hidden" name="type" value="{{ Request::get('type') }}">
                    </div>
                    @if (Request::get('type') != 'break' && Request::get('type') != 'after-break')
                        <div class="row mt-3 p-3">
                            <center>
                                <span for="">
                                    <strong>
                                        Reason
                                    </strong>
                                </span>
                            </center>
                            <textarea name="note" id="note" class="form-control" required></textarea>
                        </div>
                    @endif

                    <div class="filter-sec-btn mt-32">
                        <div class="reset-btn" onclick="location.href='{{ route('pwa-homepage') }}'">
                            <a href="#">Back</a>
                        </div>
                        <div class="filter-btn" onclick="submitAttend()">
                            <a href="#" >Submit</a>
                        </div>
                    </div>
                </div>
            </section>
        </form>
    </section>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Fungsi untuk mendapatkan IP pengguna
            function getUserIP() {
                return '{{ request()->ip() }}';
            }

            // Ambil lokasi pengguna
            function getLocation() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        $('.latitude').val(position.coords.latitude);
                        $('.longitude').val(position.coords.longitude);
                    }, function() {
                        showAlert('You must turn on the location and reload the page to be able to continue!!');
                    });
                } else {
                    showAlert('You must turn on the location and reload the page to be able to continue!!');
                }
            }

            // Panggil fungsi untuk mendapatkan lokasi
            getLocation();




        });
        // Fungsi untuk menampilkan SweetAlert
        function showAlert(message) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: message,
            });
        }

        function submitAttend(e) {
            let type = '{{ Request::get('type') }}'
            if ($('.image-absen').val() === '') {
                showAlert('Take Photos First!!');
                e.preventDefault(); // Cegah pengiriman form jika gambar tidak ada
            }

            if (type != 'break' && type != 'after-break') {
                if ($('#note').val() === '') {
                    showAlert('Reason cannot be empty!!');
                    e.preventDefault(); // Cegah pengiriman form jika gambar tidak ada
                }
            }

            if ($('#lat').val() === '' || $('#long').val() === '') {
                    showAlert('You must turn on the location and reload the page to be able to continue!!');
                    e.preventDefault(); // Cegah pengiriman form jika gambar tidak ada
                }
            $('.form').submit();
        }
    </script>

    <script>
        // CSRF TOKEN
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // take snapshot

        $('#ulangi').hide();
        Webcam.set({
            width: 300,
            height: 400,
            image_format: 'jpeg',
            jpeg_quality: 90,
        });
        Webcam.attach('#my_camera');

        function take_snapshot() {
            Webcam.snap(function(data_uri) {
                console.log(data_uri);
                $(".image-absen").val(data_uri);
                document.getElementById('results').innerHTML = '<img src="' + data_uri + '"/>';
                $('#my_camera').hide();
                $('#ulangi').show();
            });
        }
        $('#ulangi').on('click', function(e) {
            $('#results').html('');
            $('#my_camera').show();
            $('#ulangi').hide();
            $('.image-absen').val('');
        })
        $('#take_in').on('click', function(e) {
            take_snapshot();
        })

        function showTime() {
            var a_p = "";
            var today = new Date();
            var week = new Array(
                "Minggu",
                "Senin",
                "Selasa",
                "Rabu",
                "Kamis",
                "Jumat",
                "Sabtu"
            );
            const monthNames = [
                "January",
                "February",
                "March",
                "April",
                "May",
                "June",
                "July",
                "August",
                "September",
                "October",
                "November",
                "December",
            ];
            var day = week[today.getDay()];
            var date = today.getDate();
            var month = monthNames[today.getMonth()];
            var year = today.getUTCFullYear();
            var curr_hour = today.getHours();
            var curr_minute = today.getMinutes();
            var curr_second = today.getSeconds();
            if (curr_hour < 12) {
                a_p = "AM";
            } else {
                a_p = "PM";
            }
            if (curr_hour == 0) {
                curr_hour = 12;
            }
            if (curr_hour > 12) {
                curr_hour = curr_hour - 12;
            }
            curr_hour = checkTime(curr_hour);
            curr_minute = checkTime(curr_minute);
            curr_second = checkTime(curr_second);
            // document.getElementById('date_day').innerHTML = day + ", " + date + " " + month + " " + year;
            // document.getElementById('clock').innerHTML = curr_hour + ":" + curr_minute + ":" + curr_second + " " + a_p;
        }

        function checkTime(i) {
            if (i < 10) {
                i = "0" + i;
            }
            return i;
        }
        setInterval(showTime, 500);
        //-->
    </script>
@endsection

@section('script-pwa')
@endsection
