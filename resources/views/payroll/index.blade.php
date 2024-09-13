@extends('layouts.app')

@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

@endsection

@section('header-info-content')
    
@endsection
@section('content')

{{-- <div class="row">
    <div class="col-12 col-md-4 col-lg-4" style="z-index: -99999999">
        <div class="card radius-10 bg-primary">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-0 text-white">Base Salary</p>
                        <h4 class="my-1 text-white">Rp.11,500,000.00</h4>
                    </div>
                    <div class="widgets-icons bg-white text-danger ms-auto">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-4 col-lg-4" style="z-index: -99999999">
        <div class="card radius-10 bg-primary">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-0 text-white">Reimbursment</p>
                        <h4 class="my-1 text-white">3</h4>
                    </div>
                    <div class="widgets-icons bg-white text-danger ms-auto">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-4 col-lg-4" style="z-index: -99999999">
        <div class="card radius-10 bg-primary">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-0 text-white">Loan Credits</p>
                        <h4 class="my-1 text-white">Rp.7,500,000.00</h4>
                    </div>
                    <div class="widgets-icons bg-white text-danger ms-auto">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<div class="row">
    <div class="col-lg-10">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive mt-4 mt-sm-0">
                    <table class="table align-middle table-nowrap table-check">
                        <thead>
                            <tr class="bg-transparent">
                                <th>No</th>
                                <th>Transaction ID</th>
                                <th>Date</th>
                                <th>Account No</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table><!-- end table -->
                </div>
            </div>
            <!-- end card body -->
        </div>
    </div>
    <div class="col-lg-2">
        <div class="col-12" style="z-index: -99999999">
            <div class="card radius-10 bg-primary">
                <div class="card-body">
                    <div class="col-lg-12">
                            <p class="mb-0 text-white">Loan Credits</p>
                            <h4 class="my-1 text-white">Rp.7,500,000.00</h4>
                    </div>
                    <div class="row mt-4">
                        <div class="col-lg-6">
                            <h5 class="card-title mb-1">Nuke Hapsari</h5>
                        </div>
                        <div class="col-lg-6">
                            <h5 class="card-title mb-1">*** **** **** 7676</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body pb-1">
                  <div class="d-flex align-items-start">
                      <div class="flex-grow-1">
                          <h5 class="card-title mb-2">Loan History</h5>
                      </div>
                      <div class="flex-shrink-0">
                          <div class="dropdown">
                              <a class=" dropdown-toggle" href="#" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <span class="text-muted">View All<i class="mdi mdi-chevron-down ms-1"></i></span>
                              </a>
      
                              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton2">
                                  <a class="dropdown-item" href="#">Members</a>
                                  <a class="dropdown-item" href="#">New Members</a>
                                  <a class="dropdown-item" href="#">Old Members</a>
                              </div>
                          </div>
                      </div>
                  </div>

                <div class="mx-n4 px-4" data-simplebar style="height: 258px;">
                        <div class="mt-3">
                            <ol class="activity-checkout mb-0 mt-2 ps-3">
                                <li class="">
                                    <div class="feed-item-list">
                                        <div class="d-flex">
                                            <div class="flex-grow-1 overflow-hidden me-4">
                                                <h5 class="font-size-15 mb-1 text-truncate">LN0132-12</h5>
                                                <p class="text-truncate text-muted mb-2">Rp 500,500.00</p>
                                            </div>
                                            <div class="flex-shrink-0 text-end">
                                                <h5 class="mb-1 font-size-15">12:45 PM</h5>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="">
                                    <div class="feed-item-list">
                                        <div class="d-flex">
                                            <div class="flex-grow-1 overflow-hidden me-4">
                                                <h5 class="font-size-15 mb-1 text-truncate">LN0132-12</h5>
                                                <p class="text-truncate text-muted mb-2">Rp 500,500.00</p>
                                            </div>
                                            <div class="flex-shrink-0 text-end">
                                                <h5 class="mb-1 font-size-15">12:45 PM</h5>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="">
                                    <div class="feed-item-list">
                                        <div class="d-flex">
                                            <div class="flex-grow-1 overflow-hidden me-4">
                                                <h5 class="font-size-15 mb-1 text-truncate">LN0132-12</h5>
                                                <p class="text-truncate text-muted mb-2">Rp 500,500.00</p>
                                            </div>
                                            <div class="flex-shrink-0 text-end">
                                                <h5 class="mb-1 font-size-15">12:45 PM</h5>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="">
                                    <div class="feed-item-list">
                                        <div class="d-flex">
                                            <div class="flex-grow-1 overflow-hidden me-4">
                                                <h5 class="font-size-15 mb-1 text-truncate">LN0132-12</h5>
                                                <p class="text-truncate text-muted mb-2">Rp 500,500.00</p>
                                            </div>
                                            <div class="flex-shrink-0 text-end">
                                                <h5 class="mb-1 font-size-15">12:45 PM</h5>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ol>
                        </div>
                   </div>

                  <div id="chart-area" data-colors='["--bs-primary"]' class="apex-charts"></div>

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
    $('#receive-order-table').DataTable({
        processing: false,
        serverSide: true,
        ajax: '{{ route('receive-order-get-data') }}',
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'quotation_number', name: 'quotation_number' },
            { data: 'company_code', name: 'company_code' },
            { data: 'product_type', name: 'product_type' },
            { data: 'material_detail', name: 'material_detail' },
            { data: 'thickness', name: 'thickness' },
            { data: 'po_number', name: 'po_number' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });

});
</script>
@endsection