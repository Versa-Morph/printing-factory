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
                            <h4 class="card-title">Quotation</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3"style="text-align: left">
                                        <label class="form-label">Quotation <small class="text-danger">*</small></label>
                                        <select class="form-select mr-sm-2 @error('quotation') is-invalid @enderror" id="quotation" name="quotation" style="width:100%">
                                            <option disabled selected>Choose Quotation</option>
                                            @foreach ($quotations as $quotation)
                                            <option value="{{ $quotation->id }}"
                                                {{ old('quotation') == $quotation->id ? 'selected' : '' }}>
                                                {{ $quotation->quotation_number }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom01">Order Number <small class="text-danger">*</small></label>
                                        <input type="text" class="form-control" name="order_number" placeholder="Ex:QT001..">
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
                                        <input readonly type="text" class="form-control" name="quotation_number" placeholder="Ex:QT001..">
                                    </div>
                                </div><!-- end col -->
        
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom01">PO Number</label>
                                        <input readonly type="text" class="form-control" name="po_number" placeholder="Ex:PO001">
                                    </div>
                                </div><!-- end col -->

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom01">Company Code</label>
                                        <input readonly type="text" class="form-control" name="company_code" placeholder="Ex:..">
                                    </div>
                                </div><!-- end col -->

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom01">Reduction</label>
                                        <input readonly type="number" class="form-control" name="reduction" placeholder="Ex:10">
                                    </div>
                                </div><!-- end col -->

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom01">Position</label>
                                        <input readonly type="text" class="form-control" name="position" placeholder="Ex:Potrait">
                                    </div>
                                </div><!-- end col -->
        
        
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom01">Discount Percent</label>
                                        <input readonly type="number" class="form-control" name="discount_percent" placeholder="Ex:10 %">
                                    </div>
                                </div><!-- end col -->
        
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom01">Discount Price</label>
                                        <input readonly type="number" class="form-control" name="price" placeholder="Ex:100.000">
                                    </div>
                                </div><!-- end col -->

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom01">Discount Price</label>
                                        <input readonly type="number" class="form-control" name="price" placeholder="Ex:100.000">
                                    </div>
                                </div><!-- end col -->
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header justify-content-between d-flex align-items-center">
                            <h4 class="card-title">Order</h4>
                        </div>
                        <div class="card-body">
                            <div class="row mt-2">
                                <div class="col-md-4">
                                    <label class="col-md-2 col-form-label">Status Order<small class="text-danger">*</small></label>
                                    <select class="form-select" name="status_order">
                                        <option selected value="normal">normal</option>
                                        <option value="issue">issue</option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-md-2 col-form-label">Priority<small class="text-danger">*</small></label>
                                    <select class="form-select" name="priority">
                                        <option selected value="Not Urgent">Not Urgent</option>
                                        <option value="Less Urgent">Less Urgent</option>
                                        <option value="Urgent">Urgent</option>
                                        <option value="Top Urgent">Top Urgent</option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom01">Job No</label>
                                        <input type="text" class="form-control" name="job_no" placeholder="Ex:">
                                    </div>
                                </div><!-- end col -->

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom01">Delivery DateTime</label>
                                        <input type="datetime-local" class="form-control" name="delivery_datetime" placeholder="Ex:">
                                    </div>
                                </div><!-- end col -->

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom01">Received DateTime</label>
                                        <input type="datetime-local" class="form-control" name="received_datetime" placeholder="Ex:">
                                    </div>
                                </div><!-- end col -->

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom01">Designer Start DateTime</label>
                                        <input type="datetime-local" class="form-control" name="designer_start_datetime" placeholder="Ex:">
                                    </div>
                                </div><!-- end col -->

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom01">Designer End DateTime</label>
                                        <input type="datetime-local" class="form-control" name="designer_end_datetime" placeholder="Ex:">
                                    </div>
                                </div><!-- end col -->

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom01">Operator Start DateTime</label>
                                        <input type="datetime-local" class="form-control" name="operator_start_datetime" placeholder="Ex:">
                                    </div>
                                </div><!-- end col -->

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom01">Operator End DateTime</label>
                                        <input type="datetime-local" class="form-control" name="operator_end_datetime" placeholder="Ex:">
                                    </div>
                                </div><!-- end col -->
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header justify-content-between d-flex align-items-center">
                            <h4 class="card-title">Order Management Remarks</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <h4>Order Management Remarks</h4>
                            <hr>
                            <div class="row mt-2">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-hover" id="orderRemarksTable">
                                            <thead>
                                                <tr>
                                                    <th>Order Remark<small class="text-danger">*</small></th>
                                                    <th>ACTION</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <textarea name="remark[]" placeholder="Remark" class="form-control" id="remark" rows="4"></textarea>
                                                    </td>

                                                    <td>
                                                        <button type="button" class="btn btn-outline-success" id="btn-add-document" onclick="addOrderRemarks()">
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
                            <h4 class="card-title">Order Management Color</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <h4>Order Management Color</h4>
                            <hr>
                            <div class="row mt-2">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-hover" id="orderColorsTable">
                                            <thead>
                                                <tr>
                                                    <th>Color Name<small class="text-danger">*</small></th>
                                                    <th>ACTION</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <input type="text" class="form-control" name="color_name[]" placeholder="Ex:">
                                                    </td>

                                                    <td>
                                                        <button type="button" class="btn btn-outline-success" id="btn-add-document" onclick="addOrderColors()">
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
                            <h4 class="card-title">Order Management Size</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <h4>Order Management Size</h4>
                            <hr>
                            <div class="row mt-2">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-hover" id="orderSizesTable">
                                            <thead>
                                                <tr>
                                                    <th>Size 1<small class="text-danger">*</small></th>
                                                    <th>Size 2<small class="text-danger">*</small></th>
                                                    <th>Quantity<small class="text-danger">*</small></th>
                                                    <th>ACTION</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <input type="number" class="form-control" name="size1[]" placeholder="Ex:">
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control" name="size2[]" placeholder="Ex:">
                                                    </td>

                                                    <td>
                                                        <input type="number" class="form-control" name="quantity[]" placeholder="Ex:">
                                                    </td>

                                                    <td>
                                                        <button type="button" class="btn btn-outline-success" id="btn-add-document" onclick="addOrderSizes()">
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
                            <h4 class="card-title">Material</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <h4>Quotation Material</h4>
                            <hr>
                            <div class="row mt-2">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-hover" id="materialsTable">
                                            <thead>
                                                <tr>
                                                    <th>Description <small class="text-danger">*</small></th>
                                                    <th>Material <small class="text-danger">*</small></th>
                                                    <th>Unit <small class="text-danger">*</small></th>
                                                    <th>Thickness <small class="text-danger">*</small></th>
                                                    <th>Unit Price (Rp.) <small class="text-danger">*</small></th>
                                                    <th>ACTION</th>
                                                </tr>
                                            </thead>
                                            <tbody>
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

                    <a href="{{ route('order-management-list') }}" class="btn btn-danger" style="float: left">Kembali</a>
                    <button type="submit" class="btn btn-primary" style="float: right">Simpan</button>
                </form><!-- end form -->
            </div><!-- end card body -->
        </div>
    </div>
@endsection

@section('script')
<script>
  document.getElementById('quotation').addEventListener('change', function () {
    const quotation = this.value;

    if (quotation) {
        fetch(`/order-management/details/${quotation}`)
        .then(response => response.json())
        .then(data => {
            if (data) {
                    // Isi input field sesuai data quotation
                    document.querySelector('input[name="quotation_number"]').value = data.quotation_number || '';
                    document.querySelector('input[name="reduction"]').value = data.reduction || '';
                    document.querySelector('input[name="discount_percent"]').value = data.discount_percent || '';
                    document.querySelector('input[name="price"]').value = data.price || '';
                    document.querySelector('input[name="po_number"]').value = data.po_number || '';
                    document.querySelector('input[name="company_code"]').value = data.company_code || '';
                    document.querySelector('input[name="position"]').value = data.position || '';

                    // Quotation Detail
                    // Perbarui tabel Detail
                    const materialsTableBody = document.querySelector('#materialsTable tbody');
                    materialsTableBody.innerHTML = ''; // Kosongkan tabel

                    if (data.details && data.details.length > 0) {
                        data.details.forEach(detail => {
                            const row = `
                                <tr>
                                    <td>
                                        <input type="text" class="form-control" value="${detail.product_type}" name="product_type[]" placeholder="Ex:product_type..">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" value="${detail.material}" name="material[]" placeholder="Ex:material..">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" value="${detail.thickness}" name="thickness[]" placeholder="Ex:thickness..">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" value="${detail.unit}" name="unit[]" placeholder="Ex:unit..">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" value="${detail.price}" name="price[]" placeholder="Ex:price..">
                                    </td>
                                </tr>
                            `;
                            materialsTableBody.insertAdjacentHTML('beforeend', row);
                        });
                    } else {
                        // Jika tidak ada details, tambahkan baris kosong
                        materialsTableBody.innerHTML = `
                            <tr>
                                <td>

                                </td>
                            </tr>
                        `;
                    }

                    // Quotation Term & Condition
                    // Perbarui tabel Term Condition
                    const remarksTableBody = document.querySelector('#remarksTable tbody');
                    remarksTableBody.innerHTML = ''; // Kosongkan tabel

                    if (data.remarks && data.remarks.length > 0) {
                        data.remarks.forEach(remark => {
                            const row = `
                                <tr>
                                    <td>
                                        <textarea name="remark[]" class="form-control" rows="4">${remark.remark}</textarea>
                                    </td>
                                </tr>
                            `;
                            remarksTableBody.insertAdjacentHTML('beforeend', row);
                        });
                    } else {
                        // Jika tidak ada remarks, tambahkan baris kosong
                        remarksTableBody.innerHTML = `
                            <tr>
                                <td>

                                </td>
                            </tr>
                        `;
                    }

                    const termTableBody = document.querySelector('#termTable tbody');
                    termTableBody.innerHTML = ''; // Kosongkan tabel

                    if (data.terms && data.terms.length > 0) {
                        data.terms.forEach(term => {
                            console.log(term.term_condition);
                            const row = `
                                <tr>
                                    <td>
                                        <textarea name="term[]" class="form-control" rows="4">${term.term_condition}</textarea>
                                    </td>
                                </tr>
                            `;
                            termTableBody.insertAdjacentHTML('beforeend', row);
                        });
                    } else {
                        // Jika tidak ada terms, tambahkan baris kosong
                        termTableBody.innerHTML = `
                            <tr>
                                <td>

                                </td>
                            </tr>
                        `;
                    }

                }
            })
            .catch(error => console.error('Error fetching quotation details:', error));
    }
});

// Fungsi untuk menghapus baris
function removeRow(button) {
    button.closest('tr').remove();
}


</script>

<script>
    function addOrderRemarks() {
        var rowCount = $('#orderRemarksTable tr').length;
        $("#orderRemarksTable").find('tbody')
            .append(
                $('<tr>' +
                    '<td><textarea name="remark[]" placeholder="Remarks" class="form-control" id="remarks" rows="4"></textarea>' +
                    '<td style="max-width: 6% !important"><button type="button" class="btn btn-outline-danger btn-remove" onclick="$(this).parent().parent().remove();changeOptionValue();"><i class="bx bx-minus-circle mx-auto"></i></button></td>' +
                    '</tr>'
            )
        );
    }

    function addOrderColors() {
        var rowCount = $('#orderColorsTable tr').length;
        $("#orderColorsTable").find('tbody')
            .append(
                $('<tr>' +
                    '<td><input type="text" class="form-control" name="color_name[]" placeholder="Ex:color name..">' +
                    '<td style="max-width: 6% !important"><button type="button" class="btn btn-outline-danger btn-remove" onclick="$(this).parent().parent().remove();changeOptionValue();"><i class="bx bx-minus-circle mx-auto"></i></button></td>' +
                    '</tr>'
            )
        );
    }

    function addOrderSizes() {
        var rowCount = $('#orderSizesTable tr').length;
        $("#orderSizesTable").find('tbody')
            .append(
                $('<tr>' +
                    '<td><input type="number" class="form-control" name="size1[]" placeholder="Ex:size1..">' +
                    '<td><input type="number" class="form-control" name="size2[]" placeholder="Ex:size2..">' +
                    '<td><input type="number" class="form-control" name="quantity[]" placeholder="Ex:quantity..">' +
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

                // const quotationNumber = document.querySelector('input[name="quotation_number"]').value.trim();

                // if (!quotationNumber) {
                //     showError('Quotation Number Tidak boleh kosong', 'input[name="quotation_number"]');
                //     isValid = false;
                // }

                // if (isValid) {
                    const formData = new FormData(form);

                    $.ajax({
                        url: '{{ route('order-management-store') }}',
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
                                window.location.href = '{{ route('order-management-list') }}';
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
