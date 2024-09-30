<?php

namespace App\Http\Controllers;

use App\Models\StatusAttendance;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class StatusAttendanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:list-status-attendance', ['only' => ['index']]);
        $this->middleware('permission:create-status-attendance', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-status-attendance', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-status-attendance', ['only' => ['delete']]);
    }

    public function index()
    {
        $data['page_title'] = 'Status Attendance';
        return view('master-data.status-attendance.index', $data);
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = StatusAttendance::orderBy('created_at', 'desc')->get();
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
        $data['page_title'] = 'Tambah Status Attendance';
        $data['statusAttendance'] = StatusAttendance::orderBy('title','asc')->get();

        return view('master-data.status-attendance.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'title'          => 'required',
                'latitude'    => 'nullable',
                'longitude'      => 'nullable',
                'radius'   => 'nullable',
                'address'   => 'nullable',
                'status'   => 'required',
            ]);
    
            $data = new StatusAttendance();
            $data->title = $request->input('title');
            $data->latitude = $request->input('latitude');
            $data->longitude = $request->input('longitude');
            $data->radius = $request->input('radius');
            $data->address = $request->input('address');
            $data->status = $request->input('status');
            $data->save();
    
            return response()->json(['success' => true, 'msg' => 'Data Status Attendance berhasil disimpan!']);
        } catch (\Throwable $th) {
            return response()->json(['failed' => true, 'msg' => 'Gagal Simpan Data!']);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(StatusAttendance $s)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['page_title'] = 'Edit Status Attendance';
        $data['statusAttendance'] = StatusAttendance::find($id);

        return view('master-data.status-attendance.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'title'          => 'required',
                'latitude'    => 'nullable',
                'longitude'      => 'nullable',
                'radius'   => 'nullable',
                'address'   => 'nullable',
                'status'   => 'required',
            ]);
    
            $data = StatusAttendance::find($id);
            $data->title = $request->input('title');
            $data->latitude = $request->input('latitude');
            $data->longitude = $request->input('longitude');
            $data->radius = $request->input('radius');
            $data->address = $request->input('address');
            $data->status = $request->input('status');
            $data->save();
    
            return response()->json(['success' => true, 'msg' => 'Data Status Attendance berhasil diedit!']);
        } catch (\Throwable $th) {
            return response()->json(['failed' => true, 'msg' => $th->getMessage()]);
            // return response()->json(['failed' => true, 'msg' => 'Gagal Simpan Data!']);
        }
    }

    public function delete($id)
    {
        $data = StatusAttendance::find($id);
        if ($data) {
            $data->delete();
            return response()->json(['success' => 'Data Status Attendance berhasil dihapus!']);
        }
        return response()->json(['error' => 'Data Status Attendance tidak ditemukan']);
    }
}
