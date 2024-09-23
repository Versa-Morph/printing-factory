@extends('layouts.app')

@push('styles')
@endpush

@section('header-info-content')
@endsection
@section('content')
    <div class="col-lg-12 mx-auto">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">{{ $page_title }}</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <form class="form-data" id="wo-form">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom01">Item Name <small class="text-danger">*</small></label>
                                <input type="text" class="form-control" name="item_name" placeholder="Ex:Laptop">
                            </div>
                        </div><!-- end col -->

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom01">Serial Number</label>
                                <input type="text" class="form-control" name="serial_number" placeholder="Ex:32xxxx">
                            </div>
                        </div><!-- end col -->

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom01">Purchase Date</label>
                                <input type="date" class="form-control" name="purchase_date" placeholder="Ex:">
                            </div>
                        </div><!-- end col -->

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom01">Warranty Expiry</label>
                                <input type="date" class="form-control" name="warranty_expiry" placeholder="Ex:">
                            </div>
                        </div><!-- end col -->

                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label for="status-empoye" class="form-label">Condition <small class="text-danger">*</small></label>
                                <select class="form-select" id="condition" name="condition">
                                    <option selected value="Good" {{ old('condition') == 'Good' ? 'selected' : '' }}>Good</option>
                                    <option value="Fair" {{ old('condition') == 'Fair' ? 'selected' : '' }}>Fair</option>
                                    <option value="Bad" {{ old('condition') == 'Bad' ? 'selected' : '' }}>Bad</option>
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label for="status-empoye" class="form-label">Status <small class="text-danger">*</small></label>
                                <select class="form-select" id="" name="status">
                                    <option selected value="Assigned" {{ old('status') == 'Assigned' ? 'selected' : '' }}>Assigned</option>
                                    <option value="Available" {{ old('status') == 'Available' ? 'selected' : '' }}>Available</option>
                                    <option value="Returned" {{ old('status') == 'Returned' ? 'selected' : '' }}>Returned</option>
                                    <option value="Lost" {{ old('status') == 'Lost' ? 'selected' : '' }}>Lost</option>
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3"style="text-align: left">
                                <label class="form-label">Employee <small class="text-danger">*</small></label>
                                <select class="form-select mr-sm-2 @error('employee_id') is-invalid @enderror" id="employee_id" name="employee_id" style="width:100%">
                                    <option disabled selected>Choose Employee</option>
                                    @foreach ($employes as $employee)
                                    <option value="{{ $employee->id }}"
                                        {{ old('employee_id') == $employee->id ? 'selected' : '' }}>
                                        {{ $employee->employee_code }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom01">Location</label>
                                <input type="text" class="form-control" name="location" placeholder="Ex:Tanggerang">
                            </div>
                        </div><!-- end col -->

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom01">Assigned Date <small class="text-danger">*</small></label>
                                <input type="date" class="form-control" name="assigned_date" placeholder="Ex:">
                            </div>
                        </div><!-- end col -->

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom01">Return Date <small class="text-danger">*</small></label>
                                <input type="date" class="form-control" name="return_date" placeholder="Ex:">
                            </div>
                        </div><!-- end col -->

                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" placeholder="Ex: Jakarta" name="description" rows="3">{{ old('description') }}</textarea>
                            </div>
                        </div>
                        
                    </div><!-- end row -->

                    <a href="{{ route('office-inventory-list') }}" class="btn btn-danger" style="float: left">Kembali</a>
                    <button type="submit" class="btn btn-primary" style="float: right">Simpan</button>
                </form><!-- end form -->
            </div><!-- end card body -->
        </div>
    </div>
@endsection

@section('script')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

<script>
    $("#wo-form").on("submit", function() {
        $('#workingTable').DataTable().search('').draw();
        // return false;
    });

        $('.row-employee').click(function () {
            let data = $(this).find('input:checkbox');
            data.prop('checked', !data.is(':checked'));
        });

        $(function() {
            $('#workingTable').DataTable({
                "scrollY": "350px",
                "scrollCollapse": true,
                "paging": false,
                info: false,
            });
        })

        
</script>

<script>
    $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});
</script>
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

                let isValid = true;

                if (isValid) {
                    const formData = new FormData(form);

                    $.ajax({
                        url: '{{ route('office-inventory-store') }}',
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
                                window.location.href = '{{ route('office-inventory-list') }}';
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
