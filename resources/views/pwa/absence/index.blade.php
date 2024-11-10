@extends('pwa.layouts.app')

@section('style-pwa')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
@endsection

@section('content-pwa')
    <style>
        .text-heading {
            font-weight: 700;
            margin-bottom: 2% !important;
        }

        .btn.dropdown-toggle {
            border-radius: 16px !important;
            border-color: transparent !important;
        }

        .badge-ontime {
            color: rgba(160, 219, 93, 1) !important;
            background: rgba(160, 219, 93, 0.1) !important;
            padding: 10px;
            width: auto;
            font-weight: 700;
            font-size: 10px;
            text-transform: uppercase;
        }

        .badge-late {
            color: rgba(219, 93, 93, 1);
            background: rgba(219, 93, 93, 0.1);
            padding: 10px;
            width: auto;
            font-weight: 700;
            font-size: 10px;
            text-transform: uppercase;
        }

        .badge-warning {
            color: rgb(200, 219, 93);
            background: #dbc45d1a;
            padding: 10px;
            width: auto;
            font-weight: 700;
            font-size: 10px;
            text-transform: uppercase;
        }

        .badge-no-data {
            color: black;
            background: rgba(0, 0, 0, 0.1);
            padding: 10px;
            width: auto;
            font-weight: 700;
            font-size: 10px;
            text-transform: uppercase;
        }

        .badge-info {
            color: black;
            background: rgba(7, 101, 243, 0.1);
            padding: 10px;
            width: auto;
            height: auto;
            font-weight: 700;
            font-size: 10px;
            text-transform: uppercase;
        }

        .btn-create {
            background: rgba(79, 86, 211, 1);
            color: white;
            font-weight: 600;
            float: right
        }

        .filter-sec-btn {
            position: fixed;
        }
    </style>
    <div class="row align-items-end">
        @include('pwa.layouts.partials.messages')
        <div class="col-sm">
            <div>
                <div class="home-first-sec mt-32">
                    <div class="container">
                        <div class="home-first-sec-wrap">
                            <h1>Hey, {{ Auth::user()->name }}</h1>
                            <p class="mt-8">Welcome back, please be present on time and work spirit!</p>
                        </div>

                    </div>
                </div>
                <a href="#" class="btn btn-sm btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal"
                    style="float: right;margin-top:10px;margin-right:10px">
                    + Request Absence
                </a>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Request Absence</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="form-data" method="POST" action="{{ route('pwa-absence-store') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="validationCustom01">Start Date <small
                                                        class="text-danger">*</small></label>
                                                <input type="date" class="form-control" name="start_date"
                                                    placeholder="Ex:">
                                            </div>
                                        </div><!-- end col -->

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="validationCustom01">End Date <small
                                                        class="text-danger">*</small></label>
                                                <input type="date" class="form-control" name="end_date"
                                                    placeholder="Ex:">
                                            </div>
                                        </div><!-- end col -->

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="leave_type" class="form-label">Leave Type</label>
                                                <select class="form-select" id="leave_type" name="leave_type">
                                                    <option value="">Select Leave Type</option>
                                                    <option value="annual"
                                                        {{ old('leave_tyoe') == 'annual' ? 'selected' : '' }}>Annual
                                                    </option>
                                                    <option value="sick"
                                                        {{ old('leave_tyoe') == 'sick' ? 'selected' : '' }}>Sick</option>
                                                    <option value="personal"
                                                        {{ old('leave_tyoe') == 'personal' ? 'selected' : '' }}>Personal
                                                    </option>
                                                    <option value="holiday"
                                                        {{ old('leave_tyoe') == 'holiday' ? 'selected' : '' }}>Holiday
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="status" class="form-label">Status</label>
                                                <select class="form-select" id="" name="status">
                                                    <option value="">Select Status</option>
                                                    <option value="pending"
                                                        {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="approved"
                                                        {{ old('status') == 'approved' ? 'selected' : '' }}>Approved
                                                    </option>
                                                    <option value="rejected"
                                                        {{ old('status') == 'rejected' ? 'selected' : '' }}>Rejected
                                                    </option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="reason" class="form-label">Reason</label>
                                                <textarea class="form-control" id="reason" placeholder="Ex:......" name="reason" rows="3">{{ old('reason') }}</textarea>
                                            </div>
                                        </div>
                                    </div><!-- end row -->

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary btn-create">Submit</button>
                            </div>
                            </form><!-- end form -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section id="ongoing-section">
        <div class="container">
            <div class="ongoing-section-details mt-16">
                @if (count($data) > 0)
                    @foreach ($data as $item)
                        <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModalEdit{{ $item->id }}">
                            <div class="ongoing-section-details-wrap mb-3"
                                style="border: 1px solid black; padding:10px;border-radius:10px">
                                <div class="ongoing-first">
                                    <img src="{{ asset('assets/logo-polimer.png') }}" alt="course-img img-fluid"
                                        style="max-width: 100px;margin-top: 15%;">
                                </div>
                                <div class="ongoing-second">
                                    <div class="ongoing-second-wrap">
                                        <div class="ongoing-details">
                                            <h2 class="ongoing-txt1">
                                                {{ \Illuminate\Support\Str::limit($item->reason, 15) }}
                                            </h2>
                                            <div class="mt-13">
                                                <span class="ongoing-img"><img
                                                        src="{{ asset('assets-pwa/images/checkout-screen/time-icon.svg') }}"
                                                        alt="time-icon"></span>
                                                <span
                                                    class="ongoing-txt2">{{ \Carbon\Carbon::parse($item->start_date)->format('d F Y') }}
                                                    -
                                                    {{ \Carbon\Carbon::parse($item->end_date)->format('d F Y') }}</span>
                                                <br>
                                                <span class="badge badge-info">{{ $item->leave_type }}</span>
                                            </div>
                                        </div>
                                        <div class="ongoing-progressbar">
                                            @if ($item->status == 'pending')
                                                <span class="badge badge-warning">{{ $item->status }}</span>
                                            @elseif ($item->status == 'approved')
                                                <span class="badge badge-ontime">{{ $item->status }}</span>
                                            @elseif ($item->status == 'rejected')
                                                <span class="badge badge-late">{{ $item->status }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <div class="modal fade" id="exampleModalEdit{{ $item->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Request Absence</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form-data" method="POST"
                                            action="{{ route('pwa-absence-update', $item->id) }}">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom01">Start
                                                            Date</label>
                                                        <input type="date" class="form-control"
                                                            value="{{ $item->start_date }}" name="start_date"
                                                            placeholder="Ex:..">
                                                    </div>
                                                </div><!-- end col -->

                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom01">End
                                                            Date</label>
                                                        <input type="date" class="form-control"
                                                            value="{{ $item->end_date }}" name="end_date"
                                                            placeholder="Ex:..">
                                                    </div>
                                                </div><!-- end col -->

                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label for="leave_type" class="form-label">Leave Type <span
                                                                class="text-danger">*</span></label>
                                                        <select class="form-select" id="leave_type" name="leave_type">
                                                            <option value="">Select Status</option>
                                                            <option value="annual"
                                                                {{ $item->leave_type == 'annual' ? 'selected' : '' }}>
                                                                Annual
                                                            </option>
                                                            <option value="sick"
                                                                {{ $item->leave_type == 'sick' ? 'selected' : '' }}>Sick
                                                            </option>
                                                            <option value="personal"
                                                                {{ $item->leave_type == 'personal' ? 'selected' : '' }}>
                                                                Personal</option>
                                                            <option value="holiday"
                                                                {{ $item->leave_type == 'holiday' ? 'selected' : '' }}>
                                                                Holiday</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label for="status" class="form-label">Status <span
                                                                class="text-danger">*</span></label>
                                                        <select class="form-select" id="" name="status">
                                                            <option value="">Select Status</option>
                                                            <option value="pending"
                                                                {{ $item->status == 'pending' ? 'selected' : '' }}>Pending
                                                            </option>
                                                            <option value="approved"
                                                                {{ $item->status == 'approved' ? 'selected' : '' }}>
                                                                Approved
                                                            </option>
                                                            <option value="rejected"
                                                                {{ $item->status == 'rejected' ? 'selected' : '' }}>
                                                                Rejected
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label for="reason" class="form-label">Reason</label>
                                                        <textarea class="form-control" id="reason" name="reason" rows="3">{{ $item->reason }}</textarea>
                                                    </div>
                                                </div>

                                            </div><!-- end row -->

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <a class="btn btn-danger delete"
                                            data-url='{{ route('pwa-absence-delete', $item->id) }}'>Delete</a>
                                        <button type="submit" class="btn btn-primary btn-create">Submit</button>
                                    </div>
                                    </form><!-- end form -->

                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="container">
                        <center>
                            <h5 style="color:red" class="mt-2">
                                No Data Available.
                            </h5>
                        </center>
                    </div>
                @endif

            </div>
        </div>
    </section>
    <div class="filter-sec-btn mt-32">
        <div class="filter-btn" onclick="location.href='{{ route('pwa-homepage') }}'">
            <a href="#">Back To Dashboard</a>
        </div>
    </div>

    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#customer-table').DataTable({});
        });

        // Delete action
        $(document).on('click', '.delete', function() {
            var url = $(this).data('url');
            Swal.fire({
                title: 'Are you sure you want to delete this data?',
                text: "Deleted data cannot be returned!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Delete!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'GET',
                        success: function(response) {

                            if (response.success) {
                                Swal.fire(
                                    'Deleted!',
                                    response.success,
                                    'success'
                                )
                                window.location.href = '{{ route('pwa-absence-list') }}';
                            } else {
                                Swal.fire(
                                    'Error!',
                                    response.error,
                                    'error'
                                )
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection

@section('script')
@endsection
