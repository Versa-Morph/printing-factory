@extends('layouts.app')

@section('style')
@endsection

@section('header-info-content')
@endsection
@section('content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-header justify-content-between d-flex align-items-center">
            <h4 class="card-title">{{ $page_title }}</h4>
        </div><!-- end card header -->
        <div class="card-body">
            <form class="form-data">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label" for="validationCustom01">Item Name</label>
                            <input type="item_name" class="form-control" value="{{ $office_inventory->item_name }}" name="item_name" placeholder="Ex:..">
                        </div>
                    </div><!-- end col -->

                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label" for="validationCustom01">Serial Number</label>
                            <input type="date" class="form-control" value="{{ $office_inventory->serial_number }}" name="serial_number" placeholder="Ex:..">
                        </div>
                    </div><!-- end col -->

                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label" for="validationCustom01">Purchase Date</label>
                            <input type="date" class="form-control" value="{{ $office_inventory->purchase_date }}" name="purchase_date" placeholder="Ex:..">
                        </div>
                    </div><!-- end col -->

                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label" for="validationCustom01">Warranty Expiry</label>
                            <input type="date" class="form-control" value="{{ $office_inventory->warranty_expiry }}" name="warranty_expiry" placeholder="Ex:">
                        </div>
                    </div><!-- end col -->

                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="condition" class="form-label">Condition</label>
                            <select class="form-select" id="condition" name="condition">
                                <option value="Good" {{ $office_inventory->condition == 'Good' ? 'selected' : '' }}>Good</option>
                                <option value="Fair" {{ $office_inventory->condition == 'Fair' ? 'selected' : '' }}>Fair</option>
                                <option value="Bad" {{ $office_inventory->condition == 'Bad' ? 'selected' : '' }}>Bad</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="" name="status">
                                <option value="Assigned" {{ $office_inventory->status == 'Assigned' ? 'selected' : '' }}>Assigned</option>
                                <option value="Available" {{ $office_inventory->status == 'Available' ? 'selected' : '' }}>Available</option>
                                <option value="Returned" {{ $office_inventory->status == 'Returned' ? 'selected' : '' }}>Returned</option>
                                <option value="Lost" {{ $office_inventory->status == 'Lost' ? 'selected' : '' }}>Lost</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="mb-3"style="text-align: left">
                            <label class="form-label">Employee</label>
                            <select class="form-select form-select-sm mr-sm-2" id="employee_id" name="employee_id" style="width:100%">
                                <option disabled selected>Choose Employee</option>
                                @foreach ($employes as $employee)
                                <option value="{{ $employee->id }}"
                                    {{ old('employee_id', $office_inventory->employee_id) == $employee->id ? 'selected' : '' }}>
                                    {{ $employee->employee_code }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label" for="validationCustom01">Location</label>
                            <input type="text" class="form-control" value="{{ $office_inventory->location }}" name="location" placeholder="Ex:">
                        </div>
                    </div><!-- end col -->

                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label" for="validationCustom01">Assigned Date</label>
                            <input type="text" class="form-control" value="{{ $office_inventory->assigned_date }}" name="assigned_date" placeholder="Ex:">
                        </div>
                    </div><!-- end col -->
                    
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label" for="validationCustom01">Return Date</label>
                            <input type="date" class="form-control" value="{{ $office_inventory->return_date }}" name="return_date" placeholder="Ex:">
                        </div>
                    </div><!-- end col -->

                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3">{{ $office_inventory->description }}</textarea>
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
                        url: '{{ route('office-inventory-update',$office_inventory->id) }}',
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
