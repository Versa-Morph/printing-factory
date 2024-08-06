<?php

namespace App\Http\Controllers;

use App\Models\JadwalProduksi;
use App\Models\RencanaProduksi;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class JadwalProduksiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:list-jadwal-produksi', ['only' => ['index']]);
        $this->middleware('permission:create-jadwal-produksi', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-jadwal-produksi', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-jadwal-produksi', ['only' => ['delete']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['page_title'] = 'Jadwal Produksi';
        return view('produksi.jadwal_produksi.index', $data);
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = JadwalProduksi::with(['rencana' => function ($query) {
                $query->with('desain'); 
            }])->orderBy('created_at', 'desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $editUrl = route('jadwal-produksi-edit', $row->id);
                    $deleteUrl = route('jadwal-produksi-delete', $row->id);
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
        $data['page_title'] = 'Tambah Jadwal Produksi';
        $data['rencana'] = RencanaProduksi::with('desain')->orderBy('created_at','desc')->get();

        return view('produksi.jadwal_produksi.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'id_rencana' => 'required',
                'tanggal_produksi' => 'required|date',
            ]);
    
            $data = new JadwalProduksi();
            $data->id_rencana = $request->input('id_rencana');
            $data->tanggal_produksi = $request->input('tanggal_produksi');
            $data->created_by = auth()->user()->name;
            $data->save();
    
            return response()->json(['success' => true, 'msg' => 'Data Jadwal Produksi berhasil disimpan!']);
        } catch (\Throwable $th) {
            return response()->json(['failed' => true, 'msg' => 'Gagal Simpan Data!']);
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
        $data['page_title'] = 'Edit Jadwal Produksi';
        $data['rencana'] = RencanaProduksi::orderBy('created_at','desc')->get();
        $data['jadwal'] = JadwalProduksi::find($id);
        return view('produksi.jadwal_produksi.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'id_rencana' => 'required',
                'tanggal_produksi' => 'required|date',
            ]);
    
            $data = JadwalProduksi::find($id);
            $data->id_rencana = $request->input('id_rencana');
            $data->tanggal_produksi = $request->input('tanggal_produksi');
            $data->updated_by = auth()->user()->name;
            $data->save();
    
            return response()->json(['success' => true, 'msg' => 'Data Jadwal Produksi berhasil disimpan!']);
        } catch (\Throwable $th) {
            return response()->json(['failed' => true, 'msg' => 'Gagal Simpan Data!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        try {
            $data = JadwalProduksi::find($id);
            if ($data) {
                $data->delete();
                return response()->json(['success' => 'Data Jadwal Produksi berhasil dihapus!']);
            }
            return response()->json(['error' => 'Data Jadwal Produksi tidak ditemukan']);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Data Jadwal Produksi tidak ditemukan']);
        }
    }
}
