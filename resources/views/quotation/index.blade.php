@extends('layouts.app')

@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

@endsection

@section('header-info-content')

@endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card rounded-4">
            <div class="card-header rounded-top-4 d-flex justify-content-between align-items-center">
                <h3 class="m-0">Quotation Management</h3>
                <a href="{{ route('quotation-create') }}" class="btn btn-light">
                    <i class="uil uil-plus me-1"></i> Add New
                </a>
            </div>
            <div class="card-body">
                @forelse ($quotations as $quot)
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="avatar">
                                <img src="{{ asset('assets/logo-polimer.png') }}" alt="" class="avatar">
                            </div>
                            <div class="flex-grow-1 me-2 flex-wrap ms-3">
                                <h5 class="font-size-15 mb-1"><a href="#!" class="text-reset">#{{ $quot->quotation_number }}</a></h5>
                                <p class="text-muted mb-0">{{ $customers[$quot->company_code]['company_name'] ?? 'Unknown Company' }}</p>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="d-flex gap-2">
                                    <div>
                                        <a href="#" class="btn btn-light btn-sm view-details" id="view-details" data-id="{{ $quot->id }}"><i class="uil uil-check-circle"></i></a>
                                    </div>
                                    <div>
                                        <a href="{{ route('quotation-invoice', $quot->id) }}" class="btn btn-light btn-sm"><i class="uil uil-print"></i></a>
                                    </div>
                                    <div class="dropdown">
                                        <a class="btn btn-light btn-sm dropdown-toggle" href="#" role="button"
                                            data-bs-toggle="dropdown" aria-haspopup="true">
                                            <i class="icon-xs" data-feather="more-horizontal"></i>
                                        </a>
                                        <ul class='dropdown-menu dropdown-menu-end'>
                                            <li><a class="dropdown-item edit" href="{{ route('quotation-edit', $quot->id) }}">Edit</a></li>
                                            <li><a class="dropdown-item delete" href="javascript:void(0);" data-url="{{ route('quotation-delete', $quot->id) }}">Delete</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end card body -->
                    <div class="">
                        <div class="row g-0 border-top">
                            <div class="col-xl-3 col-sm-6">
                                <div class="border-end p-3 h-100">
                                    <div>
                                        <p class="text-muted font-size-13 mb-2">Created By</p>
                                        <div class="badge badge-soft-primary font-size-12">{{ $quot->created_by }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-6">
                                <div class="border-end p-3 h-100">
                                    <div>
                                        <p class="text-muted font-size-13 mb-2">Created At</p>
                                        <h5 class="font-size-14 mb-0">{{ date('d M, Y', strtotime($quot->created_at)) }}</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-6">
                                <div class="border-end p-3 h-100">
                                    <div>
                                        <p class="text-muted font-size-13 mb-2">Valid Until</p>
                                        <h5 class="font-size-14 mb-0">{{ date('d M, Y', strtotime($quot->valid_until)) }}</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-6">
                                <div class="border-end p-3 h-100">
                                    <div>
                                        <p class="text-muted font-size-13 mb-2">Status</p>
                                        @if ($quot->status == 'draft')
                                        <div class="badge bg-warning font-size-12">Draft</div>
                                        @elseif($quot->status == 'sent')
                                        <div class="badge bg-success font-size-12">Sent</div>
                                        @elseif($quot->status == 'accepted')
                                        <div class="badge bg-success font-size-12">Accepted</div>
                                        @elseif($quot->status == 'rejected')
                                        <div class="badge bg-danger font-size-12">Rejected</div>
                                        @endif
                                    </div>
                                </div>
                            </div><!-- end col -->
                        </div><!-- end row -->
                    </div>
                </div><!-- end card -->
                @empty
                    <h3>Quotatiton Not Found</h3>
                @endforelse
            </div><!-- end card body -->
            <div class="card-footer d-flex justify-content-center rounded-bottom-4">
                <div class="row g-0">
                    <div class="col-12">
                        <div class="float-sm-end">
                            <ul class="pagination pagination-rounded mb-sm-0">
                                <!-- Tombol Sebelumnya -->
                                @if ($quotations->onFirstPage())
                                    <li class="page-item disabled">
                                        <a href="#" class="page-link"><i class="mdi mdi-chevron-left"></i></a>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a href="{{ $quotations->previousPageUrl() }}" class="page-link"><i class="mdi mdi-chevron-left"></i></a>
                                    </li>
                                @endif

                                <!-- Tombol Halaman -->
                                @if ($quotations->lastPage() <= 3)
                                    <!-- Jika Halaman <= 3, Tampilkan Semua Halaman -->
                                    @foreach (range(1, $quotations->lastPage()) as $page)
                                        <li class="page-item">
                                            <a href="{{ $quotations->url($page) }}" class="page-link {{ $page == $quotations->currentPage() ? 'active' : '' }}">
                                                {{ $page }}
                                            </a>
                                        </li>
                                    @endforeach
                                @else
                                    <!-- Jika Halaman > 4, Atur Logika Standar -->
                                    @if ($quotations->currentPage() > 3)
                                        <li class="page-item">
                                            <a href="{{ $quotations->url(1) }}" class="page-link">1</a>
                                        </li>
                                        <li class="disabled"><span>...</span></li>
                                    @endif

                                    <!-- Tombol Halaman di Sekitar Halaman Aktif -->
                                    @foreach (range(max(1, $quotations->currentPage() - 1), min($quotations->lastPage(), $quotations->currentPage() + 1)) as $page)
                                        <li class="page-item">
                                            <a href="{{ $quotations->url($page) }}" class="page-link {{ $page == $quotations->currentPage() ? 'active' : '' }}">
                                                {{ $page }}
                                            </a>
                                        </li>
                                    @endforeach

                                    <!-- Tombol Halaman Terakhir -->
                                    @if ($quotations->currentPage() < $quotations->lastPage() - 2)
                                        <li class="page-item disabled"><span>...</span></li>
                                        <li class="page-item">
                                            <a href="{{ $quotations->url($quotations->lastPage()) }}" class="page-link">{{ $quotations->lastPage() }}</a>
                                        </li>
                                    @endif
                                @endif

                                <!-- Tombol Berikutnya -->
                                @if ($quotations->hasMorePages())
                                    <li class="page-item">
                                        <a href="{{ $quotations->nextPageUrl() }}" class="page-link"><i class="mdi mdi-chevron-right"></i></a>
                                    </li>
                                @else
                                    <li class="page-item disabled">
                                        <a href="#" class="page-link"><i class="mdi mdi-chevron-right"></i></a>
                                    </li>
                                @endif
                            </ul><!-- end ul -->
                        </div>
                    </div><!-- end col -->
                </div><!-- end row -->
            </div>
        </div><!-- end card -->
    </div><!-- end col -->
</div><!-- end row -->


<div id="modalContainer">
    <!-- Modal -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Approve</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBody">
                    <!-- Order details will be populated here -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<!-- jQuery and DataTables JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    // $('#quotation-table').DataTable({
    //     processing: false,
    //     serverSide: false,
    //     ajax: '{{ route('quotation-get-data') }}',
    //     columns: [
    //         { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
    //         { data: 'quotation_number', name: 'quotation_number' },
    //         { data: 'company_code', name: 'company_code' },
    //         { data: 'po_number', name: 'po_number' },
    //         {
    //             data: 'file',
    //             name: 'file',
    //             orderable: false,
    //             searchable: false,
    //             render: function(data, type, row) {
    //                 if (data) {
    //                     // Construct the file URL
    //                     return `<a href="{{ asset('assets/img/quotation') }}/${data}" target="_blank">${data}</a>`;
    //                 }
    //                 return ''; // Return empty if no file
    //             }
    //         },
    //         { data: 'action', name: 'action', orderable: false, searchable: false }
    //     ]
    // });


    // Event listener for opening modal
    $('#view-details').on('click', function() {
        var orderId = $(this).data('id');
        $.ajax({
            url: '/quotation/modal-approve/' + orderId,
            method: 'GET',
            success: function(data) {
                $('#modalBody').html(data);
                $('#detailModal').modal('show');
            },
            error: function(xhr, textStatus, errorThrown) {
                alert('There was an error fetching the details. Please try again later.');
            }
        });
    });

    // Delete action
    $(document).on('click', '.delete', function () {
        var url = $(this).data('url');
        Swal.fire({
            title: 'Yakin ingin hapus data ini?',
            text: "Data yang sudah di hapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function (response) {
                        if (response.success) {
                            Swal.fire(
                                'Deleted!',
                                response.success,
                                'success'
                            )
                            $('#quotation-table').DataTable().ajax.reload();
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
});
</script>
@endsection
