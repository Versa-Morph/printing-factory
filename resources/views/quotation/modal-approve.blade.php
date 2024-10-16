<div>
    <form action="{{ route('quotation-approve', $quotation->id) }}" method="POST" enctype="multipart/form-data">
        @method('patch')
        @csrf
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group mt-2 cash-input">
                    <label for="po_number" class="form-label">PO Number</label>
                    <input type="text" name="po_number" value="{{ old('po_number') }}" class="form-control form-control-sm" placeholder="Ex:PO001" aria-describedby="po_number">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group mt-2 cash-input">
                    <label for="quotation" class="form-label">File</label>
                    <input type="file" name="quotation" class="form-control form-control-sm" placeholder="Ex:PO001" aria-describedby="quotation">
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-12 text-end">
                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Save</button>
            </div>
        </div>
    </form>
</div>
