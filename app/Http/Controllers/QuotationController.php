<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Karyawan;
use App\Models\Quotation;
use App\Models\QuotationDetail;
use App\Models\QuotationRemarks;
use App\Models\QuotationTerms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use PDF;


class QuotationController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    //     $this->middleware('permission:list-quotation', ['only' => ['index']]);
    //     $this->middleware('permission:create-quotation', ['only' => ['create', 'store']]);
    //     $this->middleware('permission:edit-quotation', ['only' => ['edit', 'update']]);
    //     $this->middleware('permission:delete-quotation', ['only' => ['delete']]);
    // }

    public function index()
    {
        $data['page_title'] = 'Quotation';
        return view('quotation.index', $data);
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            if (Auth::user()->role == 'sales') {
                // If the user's role is 'sales', they can only see their own accounts
                $data = Quotation::orderBy('created_at', 'desc')
                                ->where('created_by', Auth::user()->name)
                                ->get();
            } else {
                $data = Quotation::orderBy('created_at', 'desc')->get();
            }
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $editUrl = route('quotation-edit', $row->id);
                    $invoiceUrl = route('quotation-invoice', $row->id);
                    $approveUrl = route('quotation-modal-approve', $row->id);
                    $deleteUrl = route('quotation-delete', $row->id);
                    $dropdown = "<div class='dropdown'>
                                    <button class='btn btn-light btn-sm dropdown-toggle' type='button' data-bs-toggle='dropdown' aria-expanded='true'>
                                        <i class='uil uil-ellipsis-h'></i>
                                    </button>
                                    <ul class='dropdown-menu dropdown-menu-end'>
                                        <li><a class='dropdown-item edit' href='$editUrl'>Edit</a></li>
                                        <li><a class='dropdown-item approve view-details' data-id='$row->id'>Approve</a></li>
                                        <li><a class='dropdown-item edit' href='$invoiceUrl'>Cetak Invoice</a></li>
                                        <li><a class='dropdown-item delete' href='javascript:void(0);' data-url='$deleteUrl'>Delete</a></li>
                                    </ul>
                                </div>";
                    return $dropdown;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function invoice($id)
    {
        $data['page_title'] = 'Invoice';
        $quotation = Quotation::findOrFail($id);
        $customer = Customer::where('company_code',$quotation->company_code)->get()->first();
        $pdf = PDF::loadView('quotation.invoice', compact('quotation','customer'));
        $pdf->setPaper('A4', 'portrait');
        $filename = 'Quotation-' . $quotation->no_quotation . '.pdf';
        return $pdf->stream($filename);
    }

    public function orderManagement()
    {
        $data['page_title'] = 'Order Management';
        return view('order-management.index', $data);
    }

    public function getDataOrderManagement(Request $request)
    {
        if ($request->ajax()) {
            if (Auth::user()->role == 'sales') {
                $data = Quotation::orderBy('po_number', 'asc')
                                ->where('status','accepted')
                                ->where('created_by', Auth::user()->name)
                                ->get();
            } else {
                $data = Quotation::orderBy('po_number', 'asc')->where('status','accepted')->get();
            }
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $editUrl = route('quotation-edit', $row->id);
                    $approveUrl = route('quotation-modal-approve', $row->id);
                    $deleteUrl = route('quotation-delete', $row->id);
                    $dropdown = "<div class='dropdown'>
                                    <button class='btn btn-light btn-sm dropdown-toggle' type='button' data-bs-toggle='dropdown' aria-expanded='true'>
                                        <i class='uil uil-ellipsis-h'></i>
                                    </button>
                                    <ul class='dropdown-menu dropdown-menu-end'>
                                        <li><a class='dropdown-item edit' href='$editUrl'>Edit</a></li>
                                        <li><a class='dropdown-item approve view-details' data-id='$row->id'>Approve</a></li>
                                        <li><a class='dropdown-item delete' href='javascript:void(0);' data-url='$deleteUrl'>Delete</a></li>
                                    </ul>
                                </div>";
                    return $dropdown;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function modalApprove($id)
    {
        $data['quotation'] = Quotation::findOrFail($id);
        return view('quotation.modal-approve',$data)->render();
    }

    public function approve(Request $request,$id)
    {
        try {
            $quotation = Quotation::findOrFail($id);
            $quotation->po_number = $request->po_number;
            $quotation->status = 'accepted';

            if ($request->hasFile('quotation')) {
                $image = $request->file('quotation');
                $name = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('assets/img/quotation/');
                $image->move($destinationPath, $name);
                $quotation->file = $name;
            }

            $quotation->save();

            return redirect()->back()->with('success', 'Berhasil Approve');
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'Gagal Approve');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['page_title'] = 'Tambah Quotation';
        $data['quotations'] = Quotation::orderBy('quotation_number','asc')->get();
        $data['customers'] = Customer::orderBy('company_name','asc')->get();

        return view('quotation.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'quotation_number'      => 'required',
                'company_code'          => 'required|string|max:225',
                'reduction'             => 'nullable',
                'position'              => 'nullable',
                'discount_percent'      => 'nullable',
                'discount_price'        => 'nullable',
                'datetime'              => 'nullable',
                'status'                => 'required',
                'status_change_at'      => 'nullable',
                'valid_until'           => 'nullable',
                'po_number'             => 'nullable',
            ]);
    
            $quotation = new Quotation();
            $quotation->quotation_number = $request->input('quotation_number');
            $quotation->company_code = $request->input('company_code');
            $quotation->reduction = $request->input('reduction');
            $quotation->position = $request->input('position');
            $quotation->discount_percent = $request->input('discount_percent');
            $quotation->discount_price = $request->input('discount_price');
            $quotation->datetime = now();
            $quotation->status = $request->input('status');
            $quotation->status_change_at = now();
            $quotation->valid_until = $request->input('valid_until');
            $quotation->po_number = $request->input('po_number');
            $quotation->created_by = Auth::user()->name;
            $quotation->save();
    
            if ($request->has('product_type') && is_array($request->product_type)) {
                $productType = [];
                foreach ($request->product_type as $key => $value) {
                    $productType[] = [
                        'quotation_id'  => $quotation->id,
                        'product_type'  => $request->product_type[$key], 
                        'material'      => $request->material[$key], 
                        'thickness'     => $request->thickness[$key], 
                        'unit'          => $request->unit[$key], 
                        'price'         => $request->price[$key], 

                    ];
                }
                QuotationDetail::insert($productType);
            }

            if ($request->has('remark') && is_array($request->remark)) {
                $remarks = [];
                foreach ($request->remark as $key => $value) {
                    $remarks[] = [
                        'quotation_id'  => $quotation->id,
                        'remark'        => $value,
                    ];
                }
                QuotationRemarks::insert($remarks);
            }
    
            if ($request->has('term_condition') && is_array($request->term_condition)) {
                $terms = [];
                foreach ($request->term_condition as $key => $value) {
                    $terms[] = [
                        'quotation_id'      => $quotation->id,
                        'term_condition'    => $value,
                    ];
                }
                QuotationTerms::insert($terms);
            }

            return response()->json(['success' => true, 'msg' => 'Data Quotaion berhasil disimpan!']);
        } catch (\Throwable $th) {
            return response()->json(['failed' => true, 'msg' => 'Gagal Simpan Data!']);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Quotation $karyawan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['page_title'] = 'Edit Quotation';
        $data['quotation'] = Quotation::find($id);
        $data['customers'] = Customer::orderBy('company_code','asc')->get();

        return view('quotation.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'quotation_number'      => 'required',
                'company_code'          => 'required|string|max:225',
                'reduction'             => 'nullable',
                'position'              => 'nullable',
                'discount_percent'      => 'nullable',
                'discount_price'        => 'nullable',
                'datetime'              => 'nullable',
                'status'                => 'required',
                'status_change_at'      => 'nullable',
                'valid_until'           => 'nullable',
                'po_number'             => 'nullable',
            ]);
    
            $quotation = Quotation::find($id);
            $quotation->quotation_number = $request->input('quotation_number');
            $quotation->company_code = $request->input('company_code');
            $quotation->reduction = $request->input('reduction');
            $quotation->position = $request->input('position');
            $quotation->discount_percent = $request->input('discount_percent');
            $quotation->discount_price = $request->input('discount_price');
            $quotation->datetime = now();
            $quotation->status = $request->input('status');
            $quotation->status_change_at = now();
            $quotation->valid_until = $request->input('valid_until');
            $quotation->po_number = $request->input('po_number');
            $quotation->updated_by = Auth::user()->name;
            $quotation->save();
    
            $quotation->quotationRemark()->delete();
            $quotation->quotationTerm()->delete();
            $quotation->quotationDetail()->delete();

            if ($request->has('product_type') && is_array($request->product_type)) {
                $productType = [];
                foreach ($request->product_type as $key => $value) {
                    $productType[] = [
                        'quotation_id'  => $quotation->id,
                        'product_type'  => $request->product_type[$key], 
                        'material'      => $request->material[$key], 
                        'thickness'     => $request->thickness[$key], 
                        'unit'          => $request->unit[$key], 
                        'price'         => $request->price[$key], 

                    ];
                }
                QuotationDetail::insert($productType);
            }

            if ($request->has('remark') && is_array($request->remark)) {
                $remarks = [];
                foreach ($request->remark as $key => $value) {
                    $remarks[] = [
                        'quotation_id'  => $quotation->id,
                        'remark'        => $value,
                    ];
                }
                QuotationRemarks::insert($remarks);
            }
    
            if ($request->has('term_condition') && is_array($request->term_condition)) {
                $terms = [];
                foreach ($request->term_condition as $key => $value) {
                    $terms[] = [
                        'quotation_id'      => $quotation->id,
                        'term_condition'    => $value,
                    ];
                }
                QuotationTerms::insert($terms);
            }

            return response()->json(['success' => true, 'msg' => 'Data Quotation berhasil diedit!']);
        } catch (\Throwable $th) {
            return response()->json(['failed' => true, 'msg' => $th->getMessage()]);
            // return response()->json(['failed' => true, 'msg' => 'Gagal Simpan Data!']);
        }
    }

    public function delete($id)
    {
        $quotation = Quotation::find($id);
        if ($quotation) {
            $quotation->delete();
            return response()->json(['success' => 'Data Quotation berhasil dihapus!']);
        }
        return response()->json(['error' => 'Data Quotation tidak ditemukan']);
    }

    // Receive Order
    public function receiveOrder()
    {
        $data['page_title'] = 'Quotation';
        return view('receive-order.index', $data);
    }

    public function getDataReceiveOrder(Request $request)
    {
        if ($request->ajax()) {
            $data = Quotation::orderBy('created_at', 'desc')->where('status','accepted')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $editUrl = route('quotation-edit', $row->id);
                    $deleteUrl = route('quotation-delete', $row->id);
                    $dropdown = "<div class='dropdown'>
                                    <button class='btn btn-light btn-sm dropdown-toggle' type='button' data-bs-toggle='dropdown' aria-expanded='true'>
                                        <i class='uil uil-ellipsis-h'></i>
                                    </button>
                                    <ul class='dropdown-menu dropdown-menu-end'>
                                        <li><a class='dropdown-item edit' href='$editUrl'>Edit</a></li>
                                        <li><a class='dropdown-item approve view-details' data-id='$row->id'>Approve</a></li>
                                        <li><a class='dropdown-item delete' href='javascript:void(0);' data-url='$deleteUrl'>Delete</a></li>
                                    </ul>
                                </div>";
                    return $dropdown;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
