<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PelangganController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:list-pelanggan', ['only' => ['index']]);
        $this->middleware('permission:create-pelanggan', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-pelanggan', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-pelanggan', ['only' => ['delete']]);
    }

    public function index()
    {
        $data['page_title'] = 'Pelanggan';
        // $data['count'] =
        return view('crm.pelanggan.index', $data);
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = Pelanggan::orderBy('created_at','desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $editUrl = route('pelanggan-edit', $row->id);
                    $deleteUrl = route('pelanggan-delete', $row->id);
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
        $data['page_title'] = 'Tambah Pelanggan';
        return view('crm.pelanggan.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama_pelanggan' => 'required|string|max:225',
                'email' => 'required|string|email|max:225',
                'telepon' => 'required|string|max:15',
                'alamat' => 'required|string',
            ]);
    
            $pelanggan = new Pelanggan;
            $pelanggan->nama_pelanggan = $request->input('nama_pelanggan');
            $pelanggan->email = $request->input('email');
            $pelanggan->telepon = $request->input('telepon');
            $pelanggan->alamat = $request->input('alamat');
            $pelanggan->save();
    
            return response()->json(['success' => true, 'msg' => 'Data Pelanggan berhasil disimpan!']);
        } catch (\Throwable $th) {
            return response()->json(['failed' => true, 'msg' => $th->getMessage()]);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Pelanggan $pelanggan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['page_title'] = 'Edit Pelanggan';
        $data['data'] = Pelanggan::find($id);
        return view('crm.pelanggan.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'nama_pelanggan' => 'required|string|max:225',
                'email' => 'required|string|email|max:225',
                'telepon' => 'required|string|max:15',
                'alamat' => 'required|string',
            ]);
    
            $pelanggan = Pelanggan::find($id);
            $pelanggan->nama_pelanggan = $request->input('nama_pelanggan');
            $pelanggan->email = $request->input('email');
            $pelanggan->telepon = $request->input('telepon');
            $pelanggan->alamat = $request->input('alamat');
            $pelanggan->save();
    
            return response()->json(['success' => true, 'msg' => 'Data Pelanggan berhasil diedit!']);
        } catch (\Throwable $th) {
            return response()->json(['failed' => true, 'msg' => $th->getMessage()]);
        }
    }

    public function delete($id)
    {
        $pelanggan = Pelanggan::find($id);
        if ($pelanggan) {
            $pelanggan->delete();
            return response()->json(['success' => 'Data Pelanggan berhasil dihapus!']);
        }
        return response()->json(['error' => 'Data Pelanggan tidak ditemukan']);
    }

}
