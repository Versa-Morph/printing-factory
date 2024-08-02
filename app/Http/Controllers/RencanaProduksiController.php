<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DesainProduct;
use App\Models\RencanaProduksi;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class RencanaProduksiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:list-rencana-produksi', ['only' => ['index']]);
        $this->middleware('permission:create-rencana-produksi', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-rencana-produksi', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-rencana-produksi', ['only' => ['delete']]);
    }

    public function index()
    {
        $data['page_title'] = 'Desain Product';
        return view('implement.rencana-produksi.index', $data);
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = RencanaProduksi::orderBy('created_at','desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $editUrl = route('rencana-produksi-edit', $row->id);
                    $deleteUrl = route('rencana-produksi-delete', $row->id);
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
        $data['page_title'] = 'Tambah Rencana Produksi';
        $data['rencana_produksis'] = RencanaProduksi::orderBy('id','asc')->get();
        $data['desain_products'] = DesainProduct::orderBy('nama_desain','asc')->get();

        return view('implement.rencana-produksi.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'id_desain'               => 'required|string|max:225',
                'jumlah_produksi'         => 'required',
                'tanggal_mulai'           => 'required',
                'tanggal_selesai'         => 'required',
                'status_rencana'          => 'required',
            ]);
    
            $rencana_produksi = new RencanaProduksi();
            $rencana_produksi->id_desain = $request->input('id_desain');
            $rencana_produksi->jumlah_produksi = $request->input('jumlah_produksi');
            $rencana_produksi->tanggal_mulai = $request->input('tanggal_mulai');
            $rencana_produksi->tanggal_selesai = $request->input('tanggal_selesai');
            $rencana_produksi->status_rencana = $request->input('status_rencana');
            $rencana_produksi->created_by = auth()->user()->name;

            $rencana_produksi->save();
    
            return response()->json(['success' => true, 'msg' => 'Data Rencana Produksi berhasil disimpan!']);
        } catch (\Throwable $th) {
            return response()->json(['failed' => true, 'msg' => $th->getMessage()]);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(RencanaProduksi $rencanaProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['page_title'] = 'Edit Rencana Produksi';
        $data['rencana_produksi'] = RencanaProduksi::find($id);
        $data['desain_products'] = DesainProduct::orderBy('nama_desain','asc')->get();

        return view('implement.rencana-produksi.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'id_desain'               => 'required',
                'jumlah_produksi'         => 'required',
                'tanggal_mulai'           => 'required',
                'tanggal_selesai'         => 'required',
                'status_rencana'          => 'required',
            ]);
    
            $rencana_produksi = RencanaProduksi::find($id);
            $rencana_produksi->id_desain = $request->input('id_desain');
            $rencana_produksi->jumlah_produksi = $request->input('jumlah_produksi');
            $rencana_produksi->tanggal_mulai = $request->input('tanggal_mulai');
            $rencana_produksi->tanggal_selesai = $request->input('tanggal_selesai');
            $rencana_produksi->status_rencana = $request->input('status_rencana');
            $rencana_produksi->updated_by = auth()->user()->name;

            $rencana_produksi->save();
    
            return response()->json(['success' => true, 'msg' => 'Data Rencana Produksi berhasil diedit!']);
        } catch (\Throwable $th) {
            return response()->json(['failed' => true, 'msg' => $th->getMessage()]);
        }
    }

    public function delete($id)
    {
        $rencana_produksi = RencanaProduksi::find($id);
        if ($rencana_produksi) {
            $rencana_produksi->delete();
            return response()->json(['success' => 'Data Rencana Produksi berhasil dihapus!']);
        }
        return response()->json(['error' => 'Data Rencana Produksi tidak ditemukan']);
    }
}
