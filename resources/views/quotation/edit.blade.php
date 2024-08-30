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
                    <div class="card">
                        <div class="card-header justify-content-between d-flex align-items-center">
                            <h4 class="card-title">Customer</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3"style="text-align: left">
                                        <label class="form-label">Company Code <small class="text-danger">*</small></label>
                                        <select class="form-select form-select-sm mr-sm-2 @error('company_code') is-invalid @enderror" id="company_code" name="company_code" style="width:100%">
                                            <option disabled selected>Choose Company Code</option>
                                            @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}"
                                                {{ old('company_code', $quotation->company_code) == $customer->company_code ? 'selected' : '' }}>
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
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom01">Quotation Number <small class="text-danger">*</small></label>
                                        <input type="text" class="form-control" value="{{ $quotation->quotation_number }}" name="quotation_number">
                                    </div>
                                </div><!-- end col -->
                                
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom01">Product Type <small class="text-danger">*</small></label>
                                        <input type="text" class="form-control" value="{{ $quotation->product_type }}" name="product_type">
                                    </div>
                                </div><!-- end col -->

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom01">Material Detail</label>
                                        <input type="text" class="form-control" value="{{ $quotation->material_detail }}" name="material_detail">
                                    </div>
                                </div><!-- end col -->

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom01">Thickness</label>
                                        <input type="number" class="form-control" value="{{ $quotation->thickness }}" name="thickness">
                                    </div>
                                </div><!-- end col -->

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom01">Reduction</label>
                                        <input type="number" class="form-control" value="{{ $quotation->reduction }}" name="reduction">
                                    </div>
                                </div><!-- end col -->
                                
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom01">Position</label>
                                        <input type="text" class="form-control" value="{{ $quotation->position }}" name="position">
                                    </div>
                                </div><!-- end col -->

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom01">Price <small class="text-danger">*</small></label>
                                        <input type="number" class="form-control" value="{{ $quotation->price }}" name="price">
                                    </div>
                                </div><!-- end col -->

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom01">Discout Percent</label>
                                        <input type="number" class="form-control" value="{{ $quotation->discount_percent }}" name="discount_percent">
                                    </div>
                                </div><!-- end col -->

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom01">Discout Price</label>
                                        <input type="number" class="form-control" value="{{ $quotation->discount_price }}" name="discount_price">
                                    </div>
                                </div><!-- end col -->
                                
                                <div class="col-md-4">
                                    <label class="col-md-2 form-label">Status <small class="text-danger">*</small></label>
                                    <select class="form-select" name="status">
                                        <option value="draft" {{ $quotation->status == 'draft' ? 'selected' : '' }}>Draft</option>
                                        <option value="sent" {{ $quotation->status == 'sent' ? 'selected' : '' }}>Sent</option>
                                        <option value="accepted" {{ $quotation->status == 'accepted' ? 'selected' : '' }}>Accepted</option>
                                        <option value="rejected" {{ $quotation->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom01">Valid Until</label>
                                        <input type="date" class="form-control" value="{{ $quotation->valid_until }}" name="valid_until">
                                    </div>
                                </div><!-- end col -->

                            </div><!-- end row -->
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header justify-content-between d-flex align-items-center">
                            <h4 class="card-title">Remark <small class="text-danger">*</small></h4>
                            <button type="button" class="btn btn-outline-success" id="btn-add-document" onclick="addQuotationRemark()">
                                <i class="bx bx-plus-circle"></i> Add Field
                            </button>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-hover" id="remarksTable">
                                            <thead>
                                                <tr>
                                                    <th>Remark</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($quotation->quotationRemark ?? [] as $key => $item)
                                                    <tr>
                                                        <td>
                                                            <textarea name="remark[]" placeholder="Remark" class="form-control" id="remark" rows="4">{{ $item->remark }}</textarea>
                                                        </td>
                                                        <td style="max-width: 6% !important">
                                                            <button type="button" class="btn btn-outline-danger btn-remove" onclick="$(this).closest('tr').remove();">
                                                                <i class="bx bx-minus-circle"></i> Remove
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header justify-content-between d-flex align-items-center">
                            <h4 class="card-title">Term Condition <small class="text-danger">*</small></h4>
                            <button type="button" class="btn btn-outline-success" id="btn-add-document" onclick="addQuotationTerm()">
                                <i class="bx bx-plus-circle"></i> Add Field
                            </button>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-hover" id="termTable">
                                            <thead>
                                                <tr>
                                                    <th>Term Condition</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($quotation->quotationTerm ?? [] as $key => $item)
                                                    <tr>
                                                        <td>
                                                            <textarea name="term_condition[]" placeholder="Remark" class="form-control" id="term_condition" rows="4">{{ $item->term_condition }}</textarea>
                                                        </td>
                                                        <td style="max-width: 6% !important">
                                                            <button type="button" class="btn btn-outline-danger btn-remove" onclick="$(this).closest('tr').remove();">
                                                                <i class="bx bx-minus-circle"></i> Remove
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
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
    function addQuotationRemark() {
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
                let isValid = true;


                if (isValid) {
                    const formData = new FormData(form);

                    $.ajax({
                        url: '{{ route('quotation-update',$quotation->id) }}',
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
