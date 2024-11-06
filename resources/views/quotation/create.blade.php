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
                                        <label class="form-label" for="validationCustom01">Reduction</label>
                                        <input type="number" class="form-control" name="reduction" placeholder="Ex:10">
                                    </div>
                                </div><!-- end col -->
        
                                <div class="col-md-4">
                                    <label class="col-md-2 col-form-label">Position <small class="text-danger">*</small></label>
                                    <select class="form-select" name="position">
                                        <option value="potrait">Potrait</option>
                                        <option value="landscape">Landscape</option>
                                    </select>
                                </div>
        
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
                                                <tr>
                                                    <td>
                                                        <select class="form-select" id="productType" name="product_type[]">
                                                            <option selected value="liquid photopolymer plate">Liquid Photopolymer Plate</option>
                                                            <option value="digitalisasi solid">Digitalisasi Solid</option>
                                                            <option value="dry offset">Dry Offset</option>
                                                            <option value="lasser film printing">Lasser Film Printing</option>
                                                            <option value="letter press">Letter Press</option>
                                                            <option value="resin polymer ppi 40">Resin Polymer PPI 40</option>
                                                            <option value="resin polymer ppa 06">Resin Polymer PPA 06</option>
                                                            <option value="base film">Base Film</option>
                                                            <option value="bopp film">BOPP Film</option>
                                                            <option value="astralon">Astralon</option>
                                                            <option value="bonding machine">Bonding Machine</option>
                                                            <option value="stripping / stoper 3m">Stripping / Stoper 3m</option>
                                                            <option value="ablative film">Ablative Film</option>
                                                            <option value="digital solid">Digital Solid</option>
                                                            <option value="letter press">Letter Press</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select class="form-select" id="" name="material[]">
                                                            <option selected value="ppi 40">PPI 40</option>
                                                            <option value="ppi 106">PPI 106</option>
                                                            <option value="huaguang">Huaguang</option>
                                                            <option value="toray">Toray </option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select class="form-select" id="" name="unit[]">
                                                            <option selected value="cm2">Cm2</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select class="form-select" id="" name="thickness[]">
                                                            <option selected value="0,175">0,175</option>
                                                            <option value="0,73">0,73</option>
                                                            <option value="0,83">0,83</option>
                                                            <option value="0,95">0,95</option>
                                                            <option value="1,14">1,14</option>
                                                            <option value="1,7">1,7</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="7">7</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control" name="price[]" placeholder="Ex:Price..">
                                                    </td>

                                                    <td>
                                                        <button type="button" class="btn btn-outline-success" id="btn-add-document" onclick="addQuotationMaterial()">
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
    document.getElementById('productType').addEventListener('change', function() {
        const thickness = document.getElementById('thickness');
        thickness.innerHTML = ''; // Clear existing options
        let options = [];
    
        if (this.value === 'liquid photopolymer plate' || this.value === 'solid photopolymer plate') {
            options = [
                { value: '3mm', text: '3mm' },
                { value: '4mm', text: '4mm' },
                { value: '3+4mm', text: '3+4mm' },
                { value: '4+3mm', text: '4+3mm' },
                { value: '7mm', text: '7mm' },
            ];
        } else if (this.value === 'digital solid photopolymer plate') {
            options = [
                { value: '1,7mm', text: '1,7mm' },
                { value: '1,14mm', text: '1,14mm' },
                { value: '0,95mm', text: '0,95mm' },
                { value: '0,75mm', text: '0,75mm' }
            ];
        }
    
        options.forEach(optionData => {
            const option = document.createElement('option');
            option.value = optionData.value;
            option.textContent = optionData.text;
            thickness.appendChild(option);
        });
    });
    
    // Trigger change event on page load to set initial thickness options
    document.getElementById('productType').dispatchEvent(new Event('change'));
</script>

<script>
    function addQuotationMaterial() {
        var rowCount = $('#materialsTable tr').length;
        $("#materialsTable").find('tbody')
            .append(
                $('<tr>' +
                    '<td><select class="form-select" id="productType" name="product_type[]"><option selected value="liquid photopolymer plate">Liquid Photopolymer Plate</option><option value="digitalisasi solid">Digitalisasi Solid</option><option value="dry offset">Dry Offset</option><option value="lasser film printing">Lasser Film Printing</option><option value="letter press">Letter Press</option><option value="resin polymer ppi 40">Resin Polymer PPI 40</option><option value="resin polymer ppa 06">Resin Polymer PPA 06</option><option value="base film">Base Film</option><option value="bopp film">BOPP Film</option><option value="astralon">Astralon</option><option value="bonding machine">Bonding Machine</option><option value="stripping / stoper 3m">Stripping / Stoper 3m</option><option value="ablative film">Ablative Film</option><option value="digital solid">Digital Solid</option><option value="letter press">Letter Press</option></select>' +
                    '<td><select class="form-select" id="" name="material[]"><option selected value="ppi 40">PPI 40</option><option value="ppi 106">PPI 106</option><option value="huaguang">Huaguang</option><option value="toray">Toray </option></select>' +
                    '<td><select class="form-select" id="" name="unit[]"><option selected value="cm2">Cm2</option></select>' +
                    '<td><select class="form-select" id="" name="thickness[]"><option selected value="0,175">0,175</option><option value="0,73">0,73</option><option value="0,83">0,83</option><option value="0,95">0,95</option><option value="1,14">1,14</option><option value="1,7">1,7</option><option value="3">3</option><option value="4">4</option><option value="7">7</option></select>' +
                    '<td><input type="number" class="form-control" name="price[]" placeholder="Ex:Price..">' +
                    '<td style="max-width: 6% !important"><button type="button" class="btn btn-outline-danger btn-remove" onclick="$(this).parent().parent().remove();changeOptionValue();"><i class="bx bx-minus-circle mx-auto"></i></button></td>' +
                    '</tr>'
            )
        );
    }

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
