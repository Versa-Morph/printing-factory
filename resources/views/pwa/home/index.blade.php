@extends('pwa.layouts.app')

@section('style-pwa')
@endsection

@section('content-pwa')
    <style>
        .bg-category {
            background: #d9d9d9 !important;
        }

        .grayscale {
            filter: grayscale(100%);
        }
        .card-content{
            padding: 20px;
            background-color: #d1dcef;
        }
    </style>
    @include('pwa.layouts.partials.messages')

    <section id="homescreen">
        <div class="home-first-sec mt-32">
            <div class="container">
                <div class="home-first-sec-wrap">
                    <h1>Hey, {{ Auth::user()->name }}</h1>
                    <p class="mt-8">Welcome back, please be present on time and work spirit!</p>
                </div>
                <div class="serachbar-homepage2 mt-24">
                    <h6 id="date_day"></h6>
                    <h4 class="font-weight-bold" id="clock"></h4>

                </div>
            </div>
        </div>
        <section id="categories-section">
            <div class="container">
                <hr class="mt-1">
                <h5>Date : <span
                        class="badge text-bg-primary">{{ date('d-m-Y') }}</span>
                @if ($shift != null)
                    <h5>Shift : <span
                            class="badge text-bg-primary">{{ isset($shift) && $shift->name == null ? '-' : $shift->name . ' (' . $shift->start_time . ' - ' . $shift->end_time . ') ' }}</span>
                    @else
                        <h5>Shift : <span class="badge text-bg-primary">-</span>
                @endif

                </h5>
                <hr>
                @if ($shift == null)
                    <div class="container">

                        <center>
                            <img src="{{ asset('assets/pwa/image/no-shift.png') }}" style="max-width: 50%;"
                                alt="category-img" />
                            <h5 style="color:red" class="mt-2">
                                Please Contact Management for your setting work schedule.
                            </h5>
                        </center>
                    </div>
                @else
                    <div class="categories-wrap mt-32">
                        <a href="{{ route('pwa-attend') }}?type=clock-in">
                            <div class="categories-content shadow-sm rounded-2 card-content">
                                <div>
                                    <center>
                                        <img src="{{ asset('assets-pwa/images/icons/clock-in.png') }}"
                                            style="max-width: 50%;" alt="category-img"
                                            class="w-100 {{ isset($cekAttendance) && $cekAttendance->clock_in != null ? 'grayscale' : '' }}">
                                    </center>
                                </div>
                                <div class="categories-title">
                                    <h3 class="category-txt1 text-center ">Clock In</h3>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('pwa-attend') }}?type=clock-out">
                            <div class="categories-content shadow-sm rounded-2 card-content">
                                <div>
                                    <center>
                                        <img src="{{ asset('assets-pwa/images/icons/clock-out.png') }}"
                                            style="max-width: 50%;" alt="category-img"
                                            class="w-100 {{ isset($cekAttendance) && $cekAttendance->clock_out != null ? 'grayscale' : '' }}">
                                    </center>
                                </div>
                                <div class="categories-title">
                                    <h3 class="category-txt1 text-center ">Clock Out</h3>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('pwa-attend') }}?type=break">
                            <div class="categories-content shadow-sm rounded-2 card-content">
                                <div>
                                    <center>
                                        <img src="{{ asset('assets-pwa/images/icons/break-time.png') }}"
                                            style="max-width: 50%;" alt="category-img"
                                            class="w-100 {{ isset($cekAttendance) && $cekAttendance->break_start != null ? 'grayscale' : '' }}">
                                    </center>
                                </div>
                                <div class="categories-title">
                                    <h3 class="category-txt1 text-center ">Break Start</h3>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('pwa-attend') }}?type=after-break">
                            <div class="categories-content shadow-sm rounded-2 card-content">
                                <div>
                                    <center>
                                        <img src="{{ asset('assets-pwa/images/icons/break-time.png') }}"
                                            style="max-width: 50%;" alt="category-img"
                                            class="w-100 {{ isset($cekAttendance) && $cekAttendance->break_end != null ? 'grayscale' : '' }}">
                                    </center>
                                </div>
                                <div class="categories-title">
                                    <h3 class="category-txt1 text-center ">Break End</h3>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('pwa-attend') }}?type=overtime-in">
                            <div class="categories-content shadow-sm rounded-2 card-content">
                                <div>
                                    <center>
                                        <img src="{{ asset('assets-pwa/images/icons/overtime.png') }}"
                                            style="max-width: 50%;" alt="category-img"
                                            class="w-100 {{ isset($cekAttendance) && $cekAttendance->overtime_in != null ? 'grayscale' : '' }}">
                                    </center>
                                </div>
                                <div class="categories-title">
                                    <h3 class="category-txt1 text-center ">Overtime In</h3>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('pwa-attend') }}?type=overtime-out">
                            <div class="categories-content shadow-sm rounded-2 card-content">
                                <div>
                                    <center>
                                        <img src="{{ asset('assets-pwa/images/icons/overtime.png') }}"
                                            style="max-width: 50%;" alt="category-img"
                                            class="w-100 {{ isset($cekAttendance) && $cekAttendance->overtime_out != null ? 'grayscale' : '' }}">
                                    </center>
                                </div>
                                <div class="categories-title">
                                    <h3 class="category-txt1 text-center ">Overtime Out</h3>
                                </div>
                            </div>
                        </a>
                    </div>
                @endif
            </div>
        </section>
    </section>
@endsection

@section('script-pwa')
    <script>
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
            document.getElementById('date_day').innerHTML = day + ", " + date + " " + month + " " + year;
            document.getElementById('clock').innerHTML = curr_hour + ":" + curr_minute + ":" + curr_second + " " + a_p;
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
