<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Employe;
use App\Models\OfficeInventory;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class OfficeInventoryController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:list-office-inventory', ['only' => ['index']]);
        $this->middleware('permission:create-office-inventory', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-office-inventory', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-office-inventory', ['only' => ['delete']]);
    }

    public function index()
    {
        $data['page_title'] = 'Office Inventory';
        return view('office-inventory.index', $data);
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = OfficeInventory::orderBy('created_at', 'desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('employee', function($row){
                    return $row->employee->employee_code;
                })
                ->addColumn('action', function($row){
                    $editUrl = route('office-inventory-edit', $row->id);
                    $deleteUrl = route('office-inventory-delete', $row->id);
                    $dropdown = "<div class='dropdown'>
                                    <button class='btn btn-light btn-sm dropdown-toggle' type='button' data-bs-toggle='dropdown' aria-expanded='true'>
                                        <i class='uil uil-ellipsis-h'></i>
                                    </button>
                                    <ul class='dropdown-menu dropdown-menu-end'>
                                        <li><a class='dropdown-item edit' href='$editUrl'>Edit</a></li>
                                        <li><a class='dropdown-item delete' href='javascript:void(0);' data-url='$deleteUrl'>Delete</a></li>
                                    </ul>
                                </div>";
                    return $dropdown;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['page_title'] = 'Tambah Office Inventory';
        $data['employes'] = Employe::orderBy('employee_code','asc')->get();

        return view('office-inventory.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'item_name'         => 'required|string|max:225',
                'serial_number'     => 'nullable',
                'description'       => 'nullable',
                'purchase_date'     => 'nullable',
                'warranty_expiry'   => 'nullable',
                'condition'         => 'required',
                'employee_id'       => 'required',
                'assigned_date'     => 'nullable',
                'return_date'       => 'nullable',
                'status'            => 'required',
                'location'          => 'nullable',
            ]);
    
            $office_inventory = new OfficeInventory();
            $office_inventory->item_name = $request->input('item_name');
            $office_inventory->serial_number = $request->input('serial_number');
            $office_inventory->description = $request->input('description');
            $office_inventory->purchase_date = $request->input('purchase_date');
            $office_inventory->warranty_expiry = $request->input('warranty_expiry');
            $office_inventory->condition = $request->input('condition');
            $office_inventory->employee_id = $request->input('employee_id');
            $office_inventory->assigned_date = $request->input('assigned_date');
            $office_inventory->return_date = $request->input('return_date');
            $office_inventory->status = $request->input('status');
            $office_inventory->location = $request->input('location');
            $office_inventory->save();
    
            return response()->json(['success' => true, 'msg' => 'Data Office Inventory berhasil disimpan!']);
        } catch (\Throwable $th) {
            return response()->json(['failed' => true, 'msg' => 'Gagal Simpan Data!']);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(OfficeInventory $office_inventory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['page_title'] = 'Edit Office Inventory';
        $data['office_inventory'] = OfficeInventory::find($id);
        $data['employes'] = Employe::orderBy('employee_code','asc')->get();

        return view('office-inventory.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'item_name'         => 'required|string|max:225',
                'serial_number'     => 'nullable',
                'description'       => 'nullable',
                'purchase_date'     => 'nullable',
                'warranty_expiry'   => 'nullable',
                'condition'         => 'required',
                'employee_id'       => 'required',
                'assigned_date'     => 'nullable',
                'return_date'       => 'nullable',
                'status'            => 'required',
                'location'          => 'nullable',
            ]);
    
            $office_inventory = OfficeInventory::find($id);
            $office_inventory->item_name = $request->input('item_name');
            $office_inventory->serial_number = $request->input('serial_number');
            $office_inventory->description = $request->input('description');
            $office_inventory->purchase_date = $request->input('purchase_date');
            $office_inventory->warranty_expiry = $request->input('warranty_expiry');
            $office_inventory->condition = $request->input('condition');
            $office_inventory->employee_id = $request->input('employee_id');
            $office_inventory->assigned_date = $request->input('assigned_date');
            $office_inventory->return_date = $request->input('return_date');
            $office_inventory->status = $request->input('status');
            $office_inventory->location = $request->input('location');
            $office_inventory->save();
    
            return response()->json(['success' => true, 'msg' => 'Data Office Inventory berhasil diedit!']);
        } catch (\Throwable $th) {
            return response()->json(['failed' => true, 'msg' => 'Gagal Simpan Data!']);
        }
    }

    public function delete($id)
    {
        $office_inventory = OfficeInventory::find($id);
        if ($office_inventory) {
            $office_inventory->delete();
            return response()->json(['success' => 'Data Office Inventory berhasil dihapus!']);
        }
        return response()->json(['error' => 'Data Office Inventory tidak ditemukan']);
    }
}
