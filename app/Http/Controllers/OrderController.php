<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderManagementColors;
use App\Models\OrderManagementDesign;
use App\Models\OrderManagementRemark;
use App\Models\OrderManagementRemarks;
use App\Models\OrderManagementSizes;
use App\Models\Pelanggan;
use App\Models\Quotation;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:list-order', ['only' => ['index']]);
        $this->middleware('permission:create-order', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-order', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-order', ['only' => ['delete']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['page_title'] = 'Order';
        return view('order.index', $data);
    }

    public function getData(Request $request)
    {
        // if ($request->ajax()) {
            // $data = Order::orderBy('created_at','desc')->get();
            $data = Order::orderBy('created_at', 'desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $editUrl = route('order-management-edit', $row->id);
                    $detailUrl = route('order-management-show', $row->id);
                    $deleteUrl = route('order-management-delete', $row->id);
                    $dropdown = "<div class='dropdown'>
                                    <button class='btn btn-light btn-sm dropdown-toggle' type='button' data-bs-toggle='dropdown' aria-expanded='true'>
                                        <i class='uil uil-ellipsis-h'></i>
                                    </button>
                                    <ul class='dropdown-menu dropdown-menu-end'>
                                        <li><a class='dropdown-item edit' href='$editUrl'>Edit</a></li>
                                        <li><a class='dropdown-item edit' href='$detailUrl'>Detail</a></li>
                                        <li><a class='dropdown-item delete' href='javascript:void(0);' data-url='$deleteUrl'>Delete</a></li>
                                    </ul>
                                </div>";
                    return $dropdown;
                })
                ->rawColumns(['action'])
                ->make(true);
        // }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['page_title'] = 'Tambah Order';
        $data['quotations'] = Quotation::orderBy('created_at','desc')->get();
        return view('order.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'order_number'              => 'required',
                'quotation_number'          => 'required',
                'po_number'                 => 'required',
                'company_code'              => 'required',
                'job_no'                    => 'nullable',
                'reduction'                 => 'nullable',
                'position'                  => 'nullable',
                'status_order'              => 'required',
                'priority'                  => 'required',
                'delivery_datetime'         => 'required',
                'received_datetime'         => 'required',
                'cc_user'                   => 'nullable|string|max:255',
                'designer_user'             => 'nullable|string|max:255',
                'designer_start_datetime'   => 'nullable|date',
                'designer_end_datetime'     => 'nullable|date',
                'operator_user'             => 'nullable|string|max:255',
                'operator_start_datetime'   => 'nullable|date',
                'operator_end_datetime'     => 'nullable|date',
            ]);

            $data = new Order();
            $data->order_number = $request->input('order_number');
            $data->quotation_number = $request->input('quotation_number');
            $data->po_number = $request->input('po_number');
            $data->company_code = $request->input('company_code');
            $data->job_no = $request->input('job_no');
            $data->reduction = $request->input('reduction');
            $data->position = $request->input('position');
            $data->status_order = $request->input('status_order');
            $data->priority = $request->input('priority');
            $data->delivery_datetime = $request->input('delivery_datetime');
            $data->received_datetime = $request->input('received_datetime');
            $data->cc_user = $request->input('cc_user');
            $data->designer_user = $request->input('designer_user');
            $data->designer_start_datetime = $request->input('designer_start_datetime');
            $data->designer_end_datetime = $request->input('designer_end_datetime');
            $data->operator_user = $request->input('operator_user');
            $data->operator_start_datetime = $request->input('operator_start_datetime');
            $data->operator_end_datetime = $request->input('operator_end_datetime');
            $data->created_by = auth()->user()->name; // Optional jika pakai auth
            $data->save();

            if ($request->has('remark') && is_array($request->remark)) {
                $orderRemark = [];
                foreach ($request->remark as $key => $value) {
                    $orderRemark[] = [
                        'order_management_id'  => $data->id,
                        'remark'               => $request->remark[$key], 
                    ];
                }
                OrderManagementRemarks::insert($orderRemark);
            }

            if ($request->has('color_name') && is_array($request->color_name)) {
                $orderColor = [];
                foreach ($request->color_name as $key => $value) {
                    $orderColor[] = [
                        'order_management_id'  => $data->id,
                        'color_name'               => $request->color_name[$key], 
                    ];
                }
                OrderManagementColors::insert($orderColor);
            }

            if ($request->has('size1') && is_array($request->size1)) {
                $orderSize = [];
                foreach ($request->size1 as $key => $value) {
                    $orderSize[] = [
                        'order_management_id'  => $data->id,
                        'size1'               => $request->size1[$key], 
                        'size2'               => $request->size2[$key], 
                        'quantity'               => $request->quantity[$key], 
                    ];
                }
                OrderManagementSizes::insert($orderSize);
            }

            return response()->json(['success' => true, 'msg' => 'Data Order berhasil disimpan!']);
        } catch (\Throwable $th) {
            return response()->json(['failed' => true, 'msg' => 'Gagal Simpan Data!', 'error' => $th->getMessage()]);
        }
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data['page_title'] = 'Detail Order';
        $data['order'] = Order::find($id);
        $data['quotations'] = Quotation::orderBy('created_at','desc')->get();
        return view('order.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['page_title'] = 'Edit Order';
        $data['order'] = Order::find($id);
        $data['quotations'] = Quotation::orderBy('created_at','desc')->get();
        return view('order.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'order_number'              => 'required',
                'quotation_number'          => 'required',
                'po_number'                 => 'required',
                'company_code'              => 'required',
                'job_no'                    => 'nullable',
                'reduction'                 => 'nullable',
                'position'                  => 'nullable',
                'status_order'              => 'required',
                'priority'                  => 'required',
                'delivery_datetime'         => 'required',
                'received_datetime'         => 'required',
                'cc_user'                   => 'nullable|string|max:255',
                'designer_user'             => 'nullable|string|max:255',
                'designer_start_datetime'   => 'nullable|date',
                'designer_end_datetime'     => 'nullable|date',
                'operator_user'             => 'nullable|string|max:255',
                'operator_start_datetime'   => 'nullable|date',
                'operator_end_datetime'     => 'nullable|date',
            ]);
    
            $data = Order::find($id);
            $data->order_number = $request->input('order_number');
            $data->quotation_number = $request->input('quotation_number');
            $data->po_number = $request->input('po_number');
            $data->company_code = $request->input('company_code');
            $data->job_no = $request->input('job_no');
            $data->reduction = $request->input('reduction');
            $data->position = $request->input('position');
            $data->status_order = $request->input('status_order');
            $data->priority = $request->input('priority');
            $data->delivery_datetime = $request->input('delivery_datetime');
            $data->received_datetime = $request->input('received_datetime');
            $data->cc_user = $request->input('cc_user');
            $data->designer_user = $request->input('designer_user');
            $data->designer_start_datetime = $request->input('designer_start_datetime');
            $data->designer_end_datetime = $request->input('designer_end_datetime');
            $data->operator_user = $request->input('operator_user');
            $data->operator_start_datetime = $request->input('operator_start_datetime');
            $data->operator_end_datetime = $request->input('operator_end_datetime');
            $data->created_by = auth()->user()->name; // Optional jika pakai auth
            $data->save();
    
            $data->orderRemark()->delete();
            $data->orderColor()->delete();
            $data->orderSize()->delete();

            if ($request->has('remark') && is_array($request->remark)) {
                $orderRemark = [];
                foreach ($request->remark as $key => $value) {
                    $orderRemark[] = [
                        'order_management_id'  => $data->id,
                        'remark'               => $request->remark[$key], 
                    ];
                }
                OrderManagementRemarks::insert($orderRemark);
            }

            if ($request->has('color_name') && is_array($request->color_name)) {
                $orderColor = [];
                foreach ($request->color_name as $key => $value) {
                    $orderColor[] = [
                        'order_management_id'  => $data->id,
                        'color_name'               => $request->color_name[$key], 
                    ];
                }
                OrderManagementColors::insert($orderColor);
            }

            if ($request->has('size1') && is_array($request->size1)) {
                $orderSize = [];
                foreach ($request->size1 as $key => $value) {
                    $orderSize[] = [
                        'order_management_id'  => $data->id,
                        'size1'               => $request->size1[$key], 
                        'size2'               => $request->size2[$key], 
                        'quantity'               => $request->quantity[$key], 
                    ];
                }
                OrderManagementSizes::insert($orderSize);
            }

            return response()->json(['success' => true, 'msg' => 'Data Order berhasil disimpan!']);
        } catch (\Throwable $th) {
            return response()->json(['failed' => true, 'msg' => 'Gagal Simpan Data!']);
        }
    }

    public function detail(Request $request, $id)
    {
        try {
            $data = Order::find($id);
        
            if ($request->has('document_name') && is_array($request->document_name)) {
                $orderDesign = [];
                foreach ($request->document_name as $key => $value) {
                    $documentPath = null;
        
                    // Cek jika file dokumen diunggah
                    if ($request->hasFile("document_path.$key")) {
                        $image = $request->file("document_path.$key");
                        $name = time() . '_' . $key . '.' . $image->getClientOriginalExtension();
                        $destinationPath = public_path('assets/images/order/design/');
                        $image->move($destinationPath, $name);
                        $documentPath = 'assets/images/order/design/' . $name;
                    }
        
                    $orderDesign[] = [
                        'order_management_id' => $data->id, // ID dari order_management
                        'document_name'       => $value, // Nama dokumen
                        'document_path'       => $documentPath, // Lokasi file dokumen
                        'uploaded_by'         => $request->uploaded_by[$key] ?? auth()->user()->name, // Nama karyawan (default user login)
                        'status'              => $request->status[$key] ?? 'waiting', // Status dokumen
                        'created_at'          => now(), // Tanggal remark dibuat
                        'updated_at'          => now(), // Tanggal remark diperbarui
                    ];
                }
        
                // Insert data ke database
                OrderManagementDesign::insert($orderDesign);
            }
        
            return response()->json(['success' => true, 'msg' => 'Data Order berhasil disimpan!']);
        } catch (\Throwable $th) {
            return response()->json(['failed' => true, 'msg' => 'Gagal Simpan Data!', 'error' => $th->getMessage()]);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        try {
            $orer = Order::find($id);
            if ($orer) {
                $orer->delete();
                return response()->json(['success' => 'Data Order berhasil dihapus!']);
            }
            return response()->json(['error' => 'Data Order tidak ditemukan']);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Data Order tidak ditemukan']);
        }
    }
}
