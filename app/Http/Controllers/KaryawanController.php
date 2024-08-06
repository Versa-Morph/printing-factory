<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class KaryawanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:list-karyawan', ['only' => ['index']]);
        $this->middleware('permission:create-karyawan', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-karyawan', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-karyawan', ['only' => ['delete']]);
    }

    public function index()
    {
        $data['page_title'] = 'Karyawan';
        return view('karyawan.index', $data);
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = Karyawan::orderBy('created_at','desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $editUrl = route('karyawan-edit', $row->id);
                    $deleteUrl = route('karyawan-delete', $row->id);
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
        $data['page_title'] = 'Tambah Karyawan';
        $data['users'] = User::orderBy('name','asc')->get();

        return view('karyawan.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'user_id'           => 'required',
                'nama_karyawan'     => 'required|string|max:225',
                'jabatan'           => 'required|string|max:225',
                'gaji'              => 'required',
                'alamat'            => 'required',
                'no_telepon'        => 'required|string|max:20',
                'email'             => 'required|string|email|max:225',
                'tanggal_lahir'     => 'required',
                'tanggal_masuk'     => 'required',
                'status'            => 'required',
            ]);
    
            $karyawan = new Karyawan();
            $karyawan->user_id = $request->input('user_id');
            $karyawan->nama_karyawan = $request->input('nama_karyawan');
            $karyawan->jabatan = $request->input('jabatan');
            $karyawan->gaji = $request->input('gaji');
            $karyawan->alamat = $request->input('alamat');
            $karyawan->no_telepon = $request->input('no_telepon');
            $karyawan->email = $request->input('email');
            $karyawan->tanggal_lahir = $request->input('tanggal_lahir');
            $karyawan->tanggal_masuk = $request->input('tanggal_masuk');
            $karyawan->status = $request->input('status');
            $karyawan->save();
    
            return response()->json(['success' => true, 'msg' => 'Data Karyawan berhasil disimpan!']);
        } catch (\Throwable $th) {
            return response()->json(['failed' => true, 'msg' => 'Gagal Simpan Data!']);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Karyawan $karyawan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['page_title'] = 'Edit Karyawan';
        $data['karyawan'] = Karyawan::find($id);
        $data['users'] = User::orderBy('name','asc')->get();

        return view('karyawan.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'user_id' => 'required',
                'nama_karyawan' => 'required|string|max:225',
                'jabatan' => 'required|string|max:225',
                'gaji' => 'required',
                'alamat' => 'required',
                'no_telepon' => 'required|string|max:20',
                'email' => 'required|string|email|max:225',
                'tanggal_lahir' => 'required',
                'tanggal_masuk' => 'required',
                'status' => 'required',
            ]);
    
            $karyawan = Karyawan::find($id);
            $karyawan->user_id = $request->input('user_id');
            $karyawan->nama_karyawan = $request->input('nama_karyawan');
            $karyawan->jabatan = $request->input('jabatan');
            $karyawan->gaji = $request->input('gaji');
            $karyawan->alamat = $request->input('alamat');
            $karyawan->no_telepon = $request->input('no_telepon');
            $karyawan->email = $request->input('email');
            $karyawan->tanggal_lahir = $request->input('tanggal_lahir');
            $karyawan->tanggal_masuk = $request->input('tanggal_masuk');
            $karyawan->status = $request->input('status');
            $karyawan->save();
    
            return response()->json(['success' => true, 'msg' => 'Data Karyawan berhasil diedit!']);
        } catch (\Throwable $th) {
            return response()->json(['failed' => true, 'msg' => 'Gagal Simpan Data!']);
        }
    }

    public function delete($id)
    {
        $karyawan = Karyawan::find($id);
        if ($karyawan) {
            $karyawan->delete();
            return response()->json(['success' => 'Data Karyawan berhasil dihapus!']);
        }
        return response()->json(['error' => 'Data Karyawan tidak ditemukan']);
    }
}
