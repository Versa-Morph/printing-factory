<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Shift;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ShiftController extends Controller
{
     // public function __construct()
    // {
    //     $this->middleware('auth');
    //     $this->middleware('permission:list-shift', ['only' => ['index']]);
    //     $this->middleware('permission:create-shift', ['only' => ['create', 'store']]);
    //     $this->middleware('permission:edit-shift', ['only' => ['edit', 'update']]);
    //     $this->middleware('permission:delete-shift', ['only' => ['delete']]);
    // }

    public function index()
    {
        $data['page_title'] = 'Shift';
        return view('master-data.shift.index', $data);
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = Shift::orderBy('created_at', 'desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $editUrl = route('shift-edit', $row->id);
                    $deleteUrl = route('shift-delete', $row->id);
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
        $data['page_title'] = 'Tambah Shift';
        $data['shifts'] = Shift::orderBy('name','asc')->get();

        return view('master-data.shift.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name'          => 'required|string|max:225',
                'start_time'    => 'required',
                'end_time'      => 'required',
                'description'   => 'nullable',
            ]);
    
            $shift = new Shift();
            $shift->name = $request->input('name');
            $shift->start_time = $request->input('start_time');
            $shift->end_time = $request->input('end_time');
            $shift->description = $request->input('description');
            $shift->save();
    
            return response()->json(['success' => true, 'msg' => 'Data Shift berhasil disimpan!']);
        } catch (\Throwable $th) {
            return response()->json(['failed' => true, 'msg' => 'Gagal Simpan Data!']);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Shift $shift)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['page_title'] = 'Edit Shift';
        $data['shift'] = Shift::find($id);

        return view('master-data.shift.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name'          => 'required|string|max:225',
                'start_time'    => 'required',
                'end_time'      => 'required',
                'description'   => 'nullable',
            ]);
    
            $shift = Shift::find($id);
            $shift->name = $request->input('name');
            $shift->start_time = $request->input('start_time');
            $shift->end_time = $request->input('end_time');
            $shift->description = $request->input('description');
            $shift->save();
    
            return response()->json(['success' => true, 'msg' => 'Data Quotation berhasil diedit!']);
        } catch (\Throwable $th) {
            return response()->json(['failed' => true, 'msg' => $th->getMessage()]);
            // return response()->json(['failed' => true, 'msg' => 'Gagal Simpan Data!']);
        }
    }

    public function delete($id)
    {
        $shift = Shift::find($id);
        if ($shift) {
            $shift->delete();
            return response()->json(['success' => 'Data Shift berhasil dihapus!']);
        }
        return response()->json(['error' => 'Data Shift tidak ditemukan']);
    }
}
