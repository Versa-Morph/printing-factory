<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\Employe;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AbsenceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:list-absence', ['only' => ['index']]);
    }

    public function index()
    {
        $data['page_title'] = 'Absence';
        return view('absence.index', $data);
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = Absence::orderBy('created_at', 'desc')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('employee', function($row){
                    return $row->employee->first_name;
                })
                ->addColumn('action', function($row){
                    $editUrl = route('absence-edit', $row->id);
                    $deleteUrl = route('absence-delete', $row->id);
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
                ->rawColumns(['employee', 'action']) // Ensure clock_in, clock_out, and action are treated as raw HTML
                ->make(true);
        }
    }

    public function indexQueue()
    {
        $data['page_title'] = 'Absence';
        return view('absence.queue', $data);
    }

    public function getDataQueue(Request $request)
    {
        if ($request->ajax()) {
            $data = Absence::orderBy('created_at', 'desc')->where('status','pending')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('employee', function($row){
                    return $row->employee->first_name;
                })
                ->addColumn('action', function($row){
                    $editUrl = route('absence-edit', $row->id);
                    $deleteUrl = route('absence-delete', $row->id);
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
                ->rawColumns(['employee', 'action']) // Ensure clock_in, clock_out, and action are treated as raw HTML
                ->make(true);
        }
    }

    public function indexHistory()
    {
        $data['page_title'] = 'Absence';
        return view('absence.history', $data);
    }

    public function getDataHistory(Request $request)
    {
        if ($request->ajax()) {
            $data = Absence::orderBy('created_at', 'desc')->where('status','approved')->where('status','rejected')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('employee', function($row){
                    return $row->employee->first_name;
                })
                ->addColumn('action', function($row){
                    $editUrl = route('absence-edit', $row->id);
                    $deleteUrl = route('absence-delete', $row->id);
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
                ->rawColumns(['employee', 'action']) // Ensure clock_in, clock_out, and action are treated as raw HTML
                ->make(true);
        }
    }

    public function create()
    {
        $data['page_title'] = 'Tambah Absence';
        $data['employes'] = Employe::orderBy('first_name','asc')->get();

        return view('absence.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'employee_id'   => 'required',
                'start_date'    => 'required',
                'end_date'      => 'required',
                'leave_type'    => 'required',
                'reason'        => 'required',
                'status'        => 'required',
            ]);
    
            $absence = new Absence();
            $absence->employee_id = $request->input('employee_id');
            $absence->start_date = $request->input('start_date');
            $absence->end_date = $request->input('end_date');
            $absence->leave_type = $request->input('leave_type');
            $absence->reason = $request->input('reason');
            $absence->status = $request->input('status');
            $absence->save();

            return response()->json(['success' => true, 'msg' => 'Data Absence berhasil disimpan!']);
        } catch (\Throwable $th) {
            return response()->json(['failed' => true, 'msg' => 'Gagal Simpan Data!']);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Absence $workSchedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['page_title'] = 'Edit Work Schedule';
        $data['absence'] = Absence::find($id);
        $data['employes'] = Employe::orderBy('first_name','asc')->get();

        return view('absence.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'employee_id'   => 'required',
                'start_date'    => 'required',
                'end_date'      => 'required',
                'leave_type'    => 'required',
                'reason'        => 'required',
                'status'        => 'required',
            ]);
    
            $absence = Absence::find($id);
            $absence->employee_id = $request->input('employee_id');
            $absence->start_date = $request->input('start_date');
            $absence->end_date = $request->input('end_date');
            $absence->leave_type = $request->input('leave_type');
            $absence->reason = $request->input('reason');
            $absence->status = $request->input('status');
            $absence->save();
    
            return response()->json(['success' => true, 'msg' => 'Data Absence berhasil diedit!']);
        } catch (\Throwable $th) {
            return response()->json(['failed' => true, 'msg' => 'Gagal Simpan Data!']);
        }
    }

    public function delete($id)
    {
        $absence = Absence::find($id);
        if ($absence) {
            $absence->delete();
            return response()->json(['success' => 'Data Absence berhasil dihapus!']);
        }
        return response()->json(['error' => 'Data Absence tidak ditemukan']);
    }
}
