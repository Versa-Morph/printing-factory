<?php

namespace App\Http\Controllers;

use App\Models\Gaji;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class GajiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:list-gaji', ['only' => ['index']]);
        $this->middleware('permission:create-gaji', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-gaji', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-gaji', ['only' => ['delete']]);
    }

    public function index()
    {
        $data['page_title'] = 'Gaji';
        return view('gaji.index', $data);
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = Gaji::with('karyawan')->orderBy('created_at', 'desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $editUrl = route('gaji-edit', $row->id);
                    $deleteUrl = route('gaji-delete', $row->id);
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

    public function getDataKaryawan($id)
    {
        try {
            $karyawan = Karyawan::find($id);
            if ($karyawan) {
                $gaji = number_format($karyawan->gaji, 0, ',', '.');
                return response()->json(['jumlah_gaji' => $gaji]);
            }
            return response()->json(['jumlah_gaji' => 0]);
        } catch (\Throwable $th) {
            return response()->json(['jumlah_gaji' => 0]);
        }
    }

    public function create()
    {
        $data['page_title'] = 'Tambah Gaji';
        $data['karyawan'] = Karyawan::all();
        return view('gaji.create', $data);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'id_karyawan' => 'required',
                'jumlah_gaji' => 'required',
                'tanggal_gaji' => 'required|date',
                'keterangan' => 'nullable|string',
            ]);
    
            $gaji = new Gaji();
            $gaji->id_karyawan = $request->input('id_karyawan');
            $gaji->jumlah_gaji = $request->input('jumlah_gaji');
            $gaji->tanggal_gaji = $request->input('tanggal_gaji');
            $gaji->keterangan = $request->input('keterangan');
            $gaji->created_by = auth()->user()->name;
            $gaji->save();
    
            return response()->json(['success' => true, 'msg' => 'Data Gaji berhasil disimpan!']);
        } catch (\Throwable $th) {
            return response()->json(['failed' => true, 'msg' => $th->getMessage()]);
            return response()->json(['failed' => true, 'msg' => 'Gagal Simpan Data!']);
        }
    }

    public function edit($id)
    {
        $data['page_title'] = 'Edit Gaji';
        $data['gaji'] = Gaji::find($id);
        $data['karyawan'] = Karyawan::all();
        return view('gaji.edit', $data);
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'id_karyawan' => 'required',
                'jumlah_gaji' => 'required',
                'tanggal_gaji' => 'required|date',
                'keterangan' => 'nullable|string',
            ]);
    
            $gaji = Gaji::find($id);
            $gaji->id_karyawan = $request->input('id_karyawan');
            $gaji->jumlah_gaji = $request->input('jumlah_gaji');
            $gaji->tanggal_gaji = $request->input('tanggal_gaji');
            $gaji->keterangan = $request->input('keterangan');
            $gaji->updated_by = auth()->user()->name;
            $gaji->save();
    
            return response()->json(['success' => true, 'msg' => 'Data Gaji berhasil diupdate!']);
        } catch (\Throwable $th) {
            return response()->json(['failed' => true, 'msg' => 'Gagal Simpan Data!']);
        }
    }

    public function delete($id)
    {
        $gaji = Gaji::find($id);
        if ($gaji) {
            $gaji->delete();
            return response()->json(['success' => 'Data Gaji berhasil dihapus!']);
        }
        return response()->json(['error' => 'Data Gaji tidak ditemukan']);
    }
}
