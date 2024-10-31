<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Employe;
use App\Models\SalesTask;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class SalesTaskController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    //     $this->middleware('permission:list-quotation', ['only' => ['index']]);
    //     $this->middleware('permission:create-quotation', ['only' => ['create', 'store']]);
    //     $this->middleware('permission:edit-quotation', ['only' => ['edit', 'update']]);
    //     $this->middleware('permission:delete-quotation', ['only' => ['delete']]);
    // }

    public function index()
    {
        $data['page_title'] = 'Sales Task';
        return view('sales-task.index', $data);
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            if (Auth::user()->role == 'sales') {
                // If the user's role is 'sales', they can only see their own accounts
                $data = SalesTask::orderBy('created_at', 'desc')
                                ->where('created_by', Auth::user()->name)
                                ->get();
            } else {
                $data = SalesTask::orderBy('created_at', 'desc')->get();
            }
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $editUrl = route('sales-task-edit', $row->id);
                    $deleteUrl = route('sales-task-delete', $row->id);
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
        $data['page_title'] = 'Tambah Sales Task';
        $data['sales_task'] = SalesTask::orderBy('task_name','asc')->get();

        return view('sales-task.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'task_name'      => 'required',
                'description'    => 'nullable',
                'due_date'       => 'nullable',
                'priority'       => 'required',
                'status'         => 'nullable',
                'remarks'        => 'nullable',
            ]);
    
            $employee = Employe::where('first_name',Auth::user()->username)->get()->first();

            $salesTask = new SalesTask();
            $salesTask->task_name = $request->input('task_name');
            $salesTask->description = $request->input('description');
            $salesTask->due_date = $request->input('due_date');
            $salesTask->priority = $request->input('priority');
            $salesTask->status = $request->input('status');
            $salesTask->remarks = $request->input('remarks');
            $salesTask->assigned_employee_id = $employee->id;
            $salesTask->save();
    
            return response()->json(['success' => true, 'msg' => 'Data Sales Task berhasil disimpan!']);
        } catch (\Throwable $th) {
            return response()->json(['failed' => true, 'msg' => 'Gagal Simpan Data!']);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Quotation $karyawan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['page_title'] = 'Edit Sales Task';
        $data['sales_task'] = SalesTask::find($id);

        return view('sales-task.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'task_name'      => 'required',
                'description'    => 'nullable',
                'due_date'       => 'nullable',
                'priority'       => 'required',
                'status'         => 'nullable',
                'remarks'        => 'nullable',
            ]);
            $employee = Employe::where('first_name',Auth::user()->username)->get()->first();
    
            $salesTask = SalesTask::find($id);
            $salesTask->task_name = $request->input('task_name');
            $salesTask->description = $request->input('description');
            $salesTask->due_date = $request->input('due_date');
            $salesTask->priority = $request->input('priority');
            $salesTask->status = $request->input('status');
            $salesTask->remarks = $request->input('remarks');
            $salesTask->assigned_employee_id = Auth::user()->name;
            $salesTask->assigned_employee_id = $employee->id;
            $salesTask->save();
    
            return response()->json(['success' => true, 'msg' => 'Data Sales Task berhasil diedit!']);
        } catch (\Throwable $th) {
            return response()->json(['failed' => true, 'msg' => 'Gagal Simpan Data!']);
        }
    }

    public function delete($id)
    {
        $salesTask = SalesTask::find($id);
        if ($salesTask) {
            $salesTask->delete();
            return response()->json(['success' => 'Data Sales Task berhasil dihapus!']);
        }
        return response()->json(['error' => 'Data Sales Task tidak ditemukan']);
    }

}
