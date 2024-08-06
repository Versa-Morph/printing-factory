<?php

namespace App\Http\Controllers;

use App\Models\LaporanProduksi;
use Illuminate\Http\Request;
use App\Models\JadwalProduksi;
use Yajra\DataTables\DataTables;

class LaporanProduksiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:list-laporan-produksi', ['only' => ['index']]);
        $this->middleware('permission:create-laporan-produksi', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-laporan-produksi', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-laporan-produksi', ['only' => ['delete']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['page_title'] = 'Laporan Produksi';
        return view('produksi.laporan_produksi.index', $data);
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = LaporanProduksi::with(['jadwal.rencana.desain'])
            ->orderBy('created_at', 'desc')
            ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $editUrl = route('laporan-produksi-edit', $row->id);
                    $deleteUrl = route('laporan-produksi-delete', $row->id);
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
        $data['page_title'] = 'Tambah Laporan Produksi';
        $data['jadwal'] = JadwalProduksi::with(['rencana' => function ($query) {
            $query->with('desain'); 
        }])->orderBy('created_at', 'desc')->get();

        return view('produksi.laporan_produksi.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'id_jadwal' => 'required',
                'jumlah_produksi' => 'required',
                'jumlah_reject' => 'required',
                'tanggal_laporan' => 'required|date',
                'keterangan' => 'required',
            ]);
    
            $data = new LaporanProduksi();
            $data->id_jadwal = $request->input('id_jadwal');
            $data->jumlah_produksi = $request->input('jumlah_produksi');
            $data->jumlah_reject = $request->input('jumlah_reject');
            $data->tanggal_laporan = $request->input('tanggal_laporan');
            $data->keterangan = $request->input('keterangan');
            $data->created_by = auth()->user()->name;
            $data->save();
    
            return response()->json(['success' => true, 'msg' => 'Data Laporan Produksi berhasil disimpan!']);
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
        $data['page_title'] = 'Edit Laporan Produksi';
        $data['jadwal'] = JadwalProduksi::with(['rencana' => function ($query) {
            $query->with('desain'); 
        }])->orderBy('created_at', 'desc')->get();
        $data['laporan'] = LaporanProduksi::find($id);
        return view('produksi.laporan_produksi.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'id_jadwal' => 'required',
                'jumlah_produksi' => 'required',
                'jumlah_reject' => 'required',
                'tanggal_laporan' => 'required|date',
                'keterangan' => 'required',
            ]);
    
            $data = LaporanProduksi::find($id);
            $data->id_jadwal = $request->input('id_jadwal');
            $data->jumlah_produksi = $request->input('jumlah_produksi');
            $data->jumlah_reject = $request->input('jumlah_reject');
            $data->tanggal_laporan = $request->input('tanggal_laporan');
            $data->keterangan = $request->input('keterangan');
            $data->updated_by = auth()->user()->name;
            $data->save();
    
            return response()->json(['success' => true, 'msg' => 'Data Laporan Produksi berhasil disimpan!']);
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
            $data = LaporanProduksi::find($id);
            if ($data) {
                $data->delete();
                return response()->json(['success' => 'Data Laporan Produksi berhasil dihapus!']);
            }
            return response()->json(['error' => 'Data Laporan Produksi tidak ditemukan']);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Data Laporan Produksi tidak ditemukan']);
        }
    }
}
