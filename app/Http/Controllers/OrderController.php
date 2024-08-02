<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Pelanggan;
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
        return view('crm.order.index', $data);
    }

    public function getData(Request $request)
    {
        // if ($request->ajax()) {
            // $data = Order::orderBy('created_at','desc')->get();
            $data = Order::with('pelanggan')->orderBy('created_at', 'desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $editUrl = route('order-edit', $row->id);
                    $deleteUrl = route('order-delete', $row->id);
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
        // }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['page_title'] = 'Tambah Order';
        $data['pelanggan'] = Pelanggan::orderBy('created_at','desc')->get();
        return view('crm.order.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'id_pelanggan' => 'required',
                'tanggal_order' => 'required|date',
                'total_harga' => 'required',
                'status_order' => 'required',
            ]);
    
            $data = new Order();
            $data->id_pelanggan = $request->input('id_pelanggan');
            $data->tanggal_order = $request->input('tanggal_order');
            $data->total_harga = $request->input('total_harga');
            $data->status_order = $request->input('status_order');
            $data->created_by = auth()->user()->name;
            $data->save();
    
            return response()->json(['success' => true, 'msg' => 'Data Order berhasil disimpan!']);
        } catch (\Throwable $th) {
            return response()->json(['failed' => true, 'msg' => $th->getMessage()]);
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['page_title'] = 'Edit Order';
        $data['order'] = Order::find($id);
        $data['pelanggan'] = Pelanggan::orderBy('created_at','desc')->get();
        return view('crm.order.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'id_pelanggan' => 'required',
                'tanggal_order' => 'required|date',
                'total_harga' => 'required',
                'status_order' => 'required',
            ]);
    
            $data = Order::find($id);
            $data->id_pelanggan = $request->input('id_pelanggan');
            $data->tanggal_order = $request->input('tanggal_order');
            $data->total_harga = $request->input('total_harga');
            $data->status_order = $request->input('status_order');
            $data->created_by = auth()->user()->name;
            $data->save();
    
            return response()->json(['success' => true, 'msg' => 'Data Order berhasil disimpan!']);
        } catch (\Throwable $th) {
            return response()->json(['failed' => true, 'msg' => $th->getMessage()]);
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
