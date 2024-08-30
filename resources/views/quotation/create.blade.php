@extends('layouts.app')

@section('style')
@endsection

@section('header-info-content')
@endsection
@section('content')
    <div class="col-lg-12 mx-auto">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">{{ $page_title }}</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <form class="form-data">
                    <div class="card">
                        <div class="card-header justify-content-between d-flex align-items-center">
                            <h4 class="card-title">Customer</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3"style="text-align: left">
                                        <label class="form-label">Company Code <small class="text-danger">*</small></label>
                                        <select class="form-select mr-sm-2 @error('company_code') is-invalid @enderror" id="company_code" name="company_code" style="width:100%">
                                            <option disabled selected>Choose Company</option>
                                            @foreach ($customers as $customer)
                                            <option value="{{ $customer->company_code }}"
                                                {{ old('company_name') == $customer->id ? 'selected' : '' }}>
                                                {{ $customer->company_code }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div><!-- end row -->
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header justify-content-between d-flex align-items-center">
                            <h4 class="card-title">Product</h4>
                        </div>
                        <div class="card-body">
                            <div class="row mt-2">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom01">Quotation Number <small class="text-danger">*</small></label>
                                        <input type="text" class="form-control" name="quotation_number" placeholder="Ex:QT001..">
                                    </div>
                                </div><!-- end col -->
        
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom01">Product Type <small class="text-danger">*</small></label>
                                        <input type="text" class="form-control" name="product_type" placeholder="Ex:Product Type">
                                    </div>
                                </div><!-- end col -->
        
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom01">Material Detail</label>
                                        <input type="text" class="form-control" name="material_detail" placeholder="Ex:Material Detail..">
                                    </div>
                                </div><!-- end col -->
        
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom01">Thickness</label>
                                        <input type="number" class="form-control" name="thickness" placeholder="Ex:100">
                                    </div>
                                </div><!-- end col -->
        
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom01">Reduction</label>
                                        <input type="number" class="form-control" name="reduction" placeholder="Ex:10">
                                    </div>
                                </div><!-- end col -->
        
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom01">Position</label>
                                        <input type="text" class="form-control" name="position" placeholder="Ex:Potrait">
                                    </div>
                                </div><!-- end col -->
        
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom01">Price <small class="text-danger">*</small></label>
                                        <input type="number" class="form-control" name="price" placeholder="Ex:1.000.000">
                                    </div>
                                </div><!-- end col -->
        
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom01">Discount Percent</label>
                                        <input type="number" class="form-control" name="discount_percent" placeholder="Ex:10 %">
                                    </div>
                                </div><!-- end col -->
        
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom01">Discount Price</label>
                                        <input type="number" class="form-control" name="price" placeholder="Ex:100.000">
                                    </div>
                                </div><!-- end col -->
        
                                <div class="col-md-4">
                                    <label class="col-md-2 col-form-label">Status <small class="text-danger">*</small></label>
                                    <select class="form-select" name="status">
                                        <option selected value="draft">Draft</option>
                                        <option value="sent">Sent</option>
                                        <option value="accepted">Accepted</option>
                                        <option value="rejected">Rejected</option>
                                    </select>
                                </div>
        
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom01">Valid Until</label>
                                        <input type="date" class="form-control" name="valid_until" placeholder="Ex:">
                                    </div>
                                </div><!-- end col -->
        
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom01">PO Number</label>
                                        <input type="text" class="form-control" name="po_number" placeholder="Ex:PO001">
                                    </div>
                                </div><!-- end col -->
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header justify-content-between d-flex align-items-center">
                            <h4 class="card-title">Remarks</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <h4>Quotation Remarks</h4>
                            <hr>
                            <div class="row mt-2">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-hover" id="remarksTable">
                                            <thead>
                                                <tr>
                                                    <th>Remarks <small class="text-danger">*</small></th>
                                                    <th>ACTION</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <textarea name="remark[]" placeholder="Remark" class="form-control" id="remark" rows="4"></textarea>
                                                    </td>

                                                    <td>
                                                        <button type="button" class="btn btn-outline-success" id="btn-add-document" onclick="addQuotationRemarks()">
                                                            <i class="bx bx-plus-circle mx-auto"></i>
                                                        </button>
                                                    <td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            </div><!-- end row -->
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header justify-content-between d-flex align-items-center">
                            <h4 class="card-title">Term Condition</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <h4>Term Condition</h4>
                            <hr>
                            <div class="row mt-2">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-hover" id="termTable">
                                            <thead>
                                                <tr>
                                                    <th>Term Condition <small class="text-danger">*</small></th>
                                                    <th>ACTION</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <textarea name="term_condition[]" placeholder="Term Condition" class="form-control" id="term_condition" rows="4"></textarea>
                                                    </td>

                                                    <td>
                                                        <button type="button" class="btn btn-outline-success" id="btn-add-document" onclick="addQuotationTerm()">
                                                            <i class="bx bx-plus-circle mx-auto"></i>
                                                        </button>
                                                    <td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            </div><!-- end row -->
                        </div>
                    </div>

                    <a href="{{ route('quotation-list') }}" class="btn btn-danger" style="float: left">Kembali</a>
                    <button type="submit" class="btn btn-primary" style="float: right">Simpan</button>
                </form><!-- end form -->
            </div><!-- end card body -->
        </div>
    </div>
@endsection

@section('script')
<script>
    function addQuotationRemarks() {
        var rowCount = $('#remarksTable tr').length;
        $("#remarksTable").find('tbody')
            .append(
                $('<tr>' +
                    '<td><textarea name="remark[]" placeholder="Remarks" class="form-control" id="remarks" rows="4"></textarea>' +
                    '<td style="max-width: 6% !important"><button type="button" class="btn btn-outline-danger btn-remove" onclick="$(this).parent().parent().remove();changeOptionValue();"><i class="bx bx-minus-circle mx-auto"></i></button></td>' +
                    '</tr>'
            )
        );
    }

    function addQuotationTerm() {
        var rowCount = $('#termTable tr').length;
        $("#termTable").find('tbody')
            .append(
                $('<tr>' +
                    '<td><textarea name="term_condition[]" placeholder="Term Condition" class="form-control" id="term_condition" rows="4"></textarea>' +
                    '<td style="max-width: 6% !important"><button type="button" class="btn btn-outline-danger btn-remove" onclick="$(this).parent().parent().remove();changeOptionValue();"><i class="bx bx-minus-circle mx-auto"></i></button></td>' +
                    '</tr>'
            )
        );
    }
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

                const quotationNumber = document.querySelector('input[name="quotation_number"]').value.trim();

                if (!quotationNumber) {
                    showError('Quotation Number Tidak boleh kosong', 'input[name="quotation_number"]');
                    isValid = false;
                }

                // if (isValid) {
                    const formData = new FormData(form);

                    $.ajax({
                        url: '{{ route('quotation-store') }}',
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
                                window.location.href = '{{ route('quotation-list') }}';
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
                // }
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
