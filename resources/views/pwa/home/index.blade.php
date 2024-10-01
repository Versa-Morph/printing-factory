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

        .card-content {
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
                <h5>Date : <span class="badge text-bg-primary">{{ date('d-m-Y') }}</span>
                    @if ($shift != null)
                        <h5>Shift : <span class="badge text-bg-primary">{{ $shift->name ?? '-' }} ({{ $shift->start_time }}
                                - {{ $shift->end_time }})</span></h5>
                    @else
                        <h5>Shift : <span class="badge text-bg-primary">-</span></h5>
                    @endif
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
                            <!-- Clock In -->
                            <a href="javascript:void(0)" onclick="handleAttendance('clock-in')">
                                <div class="categories-content shadow-sm rounded-2 card-content">
                                    <div>
                                        <center>
                                            <img src="{{ asset('assets-pwa/images/icons/clock-in.png') }}"
                                                style="max-width: 50%;" alt="category-img"
                                                class="w-100 {{ isset($cekAttendance->clock_in) ? 'grayscale' : '' }}">
                                        </center>
                                    </div>
                                    <div class="categories-title">
                                        <h3 class="category-txt1 text-center">Clock In</h3>
                                    </div>
                                </div>
                            </a>

                            <!-- Clock Out -->
                            <a href="javascript:void(0)" onclick="handleAttendance('clock-out')">
                                <div class="categories-content shadow-sm rounded-2 card-content">
                                    <div>
                                        <center>
                                            <img src="{{ asset('assets-pwa/images/icons/clock-out.png') }}"
                                                style="max-width: 50%;" alt="category-img"
                                                class="w-100 {{ isset($cekAttendance->clock_out) ? 'grayscale' : '' }}">
                                        </center>
                                    </div>
                                    <div class="categories-title">
                                        <h3 class="category-txt1 text-center">Clock Out</h3>
                                    </div>
                                </div>
                            </a>

                            <!-- Break Start -->
                            <a href="javascript:void(0)" onclick="handleAttendance('break-start')">
                                <div class="categories-content shadow-sm rounded-2 card-content">
                                    <div>
                                        <center>
                                            <img src="{{ asset('assets-pwa/images/icons/break-time.png') }}"
                                                style="max-width: 50%;" alt="category-img"
                                                class="w-100 {{ isset($cekAttendance->break_start) ? 'grayscale' : '' }}">
                                        </center>
                                    </div>
                                    <div class="categories-title">
                                        <h3 class="category-txt1 text-center">Break Start</h3>
                                    </div>
                                </div>
                            </a>

                            <!-- Break End -->
                            <a href="javascript:void(0)" onclick="handleAttendance('after-break')">
                                <div class="categories-content shadow-sm rounded-2 card-content">
                                    <div>
                                        <center>
                                            <img src="{{ asset('assets-pwa/images/icons/break-time.png') }}"
                                                style="max-width: 50%;" alt="category-img"
                                                class="w-100 {{ isset($cekAttendance->break_end) ? 'grayscale' : '' }}">
                                        </center>
                                    </div>
                                    <div class="categories-title">
                                        <h3 class="category-txt1 text-center">Break End</h3>
                                    </div>
                                </div>
                            </a>

                            <!-- Overtime In -->
                            <a href="javascript:void(0)" onclick="handleAttendance('overtime-in')">
                                <div class="categories-content shadow-sm rounded-2 card-content">
                                    <div>
                                        <center>
                                            <img src="{{ asset('assets-pwa/images/icons/overtime.png') }}"
                                                style="max-width: 50%;" alt="category-img"
                                                class="w-100 {{ isset($cekAttendance->overtime_in) ? 'grayscale' : '' }}">
                                        </center>
                                    </div>
                                    <div class="categories-title">
                                        <h3 class="category-txt1 text-center">Overtime In</h3>
                                    </div>
                                </div>
                            </a>

                            <!-- Overtime Out -->
                            <a href="javascript:void(0)" onclick="handleAttendance('overtime-out')">
                                <div class="categories-content shadow-sm rounded-2 card-content">
                                    <div>
                                        <center>
                                            <img src="{{ asset('assets-pwa/images/icons/overtime.png') }}"
                                                style="max-width: 50%;" alt="category-img"
                                                class="w-100 {{ isset($cekAttendance->overtime_out) ? 'grayscale' : '' }}">
                                        </center>
                                    </div>
                                    <div class="categories-title">
                                        <h3 class="category-txt1 text-center">Overtime Out</h3>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endif
            </div>
        </section>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function handleAttendance(type) {
            switch (type) {
                case 'clock-in':
                    if ({{ isset($cekAttendance->clock_in) ? 'true' : 'false' }}) {
                        Swal.fire('Error', 'You have already clocked in!', 'warning');
                    } else {
                        window.location.href = "{{ route('pwa-attend') }}?type=clock-in";
                    }
                    break;

                case 'clock-out':
                    if (!{{ isset($cekAttendance->clock_in) ? 'true' : 'false' }}) {
                        Swal.fire('Error', 'You must clock in first!', 'warning');
                    } else if ({{ isset($cekAttendance->clock_out) ? 'true' : 'false' }}) {
                        Swal.fire('Error', 'You have already clocked out!', 'warning');
                    } else {
                        window.location.href = "{{ route('pwa-attend') }}?type=clock-out";
                    }
                    break;

                case 'break-start':
                    if ({{ isset($cekAttendance->break_start) ? 'true' : 'false' }}) {
                        Swal.fire('Error', 'You have already started a break!', 'warning');
                    } else if (!{{ isset($cekAttendance->clock_in) ? 'true' : 'false' }}) {
                        Swal.fire('Error', 'You must clock in first before starting a break!', 'warning');
                    } else {
                        window.location.href = "{{ route('pwa-attend') }}?type=break";
                    }
                    break;

                case 'after-break':
                    if ({{ isset($cekAttendance->break_end) ? 'true' : 'false' }}) {
                        Swal.fire('Error', 'You have already ended a break!', 'warning');
                    } else if (!{{ isset($cekAttendance->break_start) ? 'true' : 'false' }}) {
                        Swal.fire('Error', 'You must start a break before ending it!', 'warning');
                    } else {
                        window.location.href = "{{ route('pwa-attend') }}?type=after-break";
                    }
                    break;

                case 'overtime-in':
                    if ({{ isset($cekAttendance->overtime_in) ? 'true' : 'false' }}) {
                        Swal.fire('Error', 'You have already clocked in for overtime!', 'warning');
                    } else {
                        window.location.href = "{{ route('pwa-attend') }}?type=overtime-in";
                    }
                    break;

                case 'overtime-out':
                    if (!{{ isset($cekAttendance->overtime_in) ? 'true' : 'false' }}) {
                        Swal.fire('Error', 'You must clock in for overtime first!', 'warning');
                    } else if ({{ isset($cekAttendance->overtime_out) ? 'true' : 'false' }}) {
                        Swal.fire('Error', 'You have already clocked out from overtime!', 'warning');
                    } else {
                        window.location.href = "{{ route('pwa-attend') }}?type=overtime-out";
                    }
                    break;

                default:
                    Swal.fire('Error', 'Invalid action!', 'warning');
                    break;
            }
        }
    </script>
@endsection

@section('script-pwa')
@endsection
