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
            font-size: 10px
        }

        .badge-late {
            color: rgba(219, 93, 93, 1);
            background: rgba(219, 93, 93, 0.1);
            padding: 10px;
            width: auto;
            font-weight: 700;
            font-size: 10px
        }

        .badge-no-data {
            color: black;
            background: rgba(0, 0, 0, 0.1);
            padding: 10px;
            width: 62%;
            font-weight: 700;
            font-size: 10px
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
                    + Request Overtime
                </a>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Request Overtime</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="form-data" method="POST" action="{{ route('pwa-overtime-store') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="validationCustom01">Subject</label>
                                                <input type="text" class="form-control" name="subject"
                                                    placeholder="Ex:Request Overtime.." required>
                                            </div>
                                        </div><!-- end col -->

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="validationCustom01">Date</label>
                                                <input type="date" class="form-control" name="date" placeholder="Ex:"
                                                    required>
                                            </div>
                                        </div><!-- end col -->

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="validationCustom01">Start Time</label>
                                                <input type="time" class="form-control" name="start_time"
                                                    placeholder="Ex:" required>
                                            </div>
                                        </div><!-- end col -->

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="validationCustom01">End Time</label>
                                                <input type="time" class="form-control" name="end_time" placeholder="Ex:"
                                                    required>
                                            </div>
                                        </div><!-- end col -->

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="validationCustom01">Description</label>
                                                <textarea name="description" class="form-control" placeholder="Ex:..." required></textarea>
                                            </div>
                                        </div><!-- end col -->

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
                @foreach ($overtime as $item)
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
                                        <h2 class="ongoing-txt1">{{ \Illuminate\Support\Str::limit($item->subject, 15) }}
                                        </h2>
                                        {{-- <h2 class="ongoing-txt1">{{ $item->subject }}</h2> --}}
                                        <div class="mt-13">
                                            <span class="ongoing-img"><img
                                                    src="{{ asset('assets-pwa/images/checkout-screen/time-icon.svg') }}"
                                                    alt="time-icon"></span>
                                            <span class="ongoing-txt2">{{ $item->start_time }} -
                                                {{ $item->end_time }}</span>
                                            <br>
                                            <span
                                                class="ongoing-txt2">{{ \Carbon\Carbon::parse($item->date)->format('d F Y') }}</span>
                                        </div>
                                    </div>
                                    <div class="ongoing-progressbar">
                                        @if ($item->status == 1)
                                            <span class="badge badge-late">Waiting Approve</span>
                                        @else
                                            <span class="badge badge-ontime">Approved</span>
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
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Request Overtime</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="form-data" method="POST"
                                        action="{{ route('pwa-overtime-update', $item->id) }}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label" for="validationCustom01">Subject</label>
                                                    <input type="text" class="form-control" required
                                                        value="{{ $item->subject }}" name="subject"
                                                        placeholder="Ex:Request Overtime..">
                                                </div>
                                            </div><!-- end col -->

                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label" for="validationCustom01">Date</label>
                                                    <input type="date" class="form-control" required
                                                        value="{{ $item->date }}" name="date" placeholder="Ex:">
                                                </div>
                                            </div><!-- end col -->

                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label" for="validationCustom01">Start Time</label>
                                                    <input type="time" class="form-control" required
                                                        value="{{ $item->start_time }}" name="start_time"
                                                        placeholder="Ex:">
                                                </div>
                                            </div><!-- end col -->

                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label" for="validationCustom01">End Time</label>
                                                    <input type="time" class="form-control" required
                                                        value="{{ $item->end_time }}" name="end_time" placeholder="Ex:">
                                                </div>
                                            </div><!-- end col -->

                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label" for="validationCustom01">Description</label>
                                                    <textarea name="description" required class="form-control" placeholder="Ex:...">{{ $item->description }}</textarea>
                                                </div>
                                            </div><!-- end col -->

                                        </div><!-- end row -->

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    @if ($item->status == 1)
                                        <a class="btn btn-danger delete"
                                            data-url='{{ route('pwa-overtime-delete', $item->id) }}'>Delete</a>
                                        <button type="submit" class="btn btn-primary btn-create">Submit</button>
                                    @endif
                                </div>
                                </form><!-- end form -->

                            </div>
                        </div>
                    </div>
                @endforeach

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
                                window.location.href = '{{ route('pwa-overtime-list') }}';
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
