<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use App\Models\Overtime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OvertimeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:list-overtime', ['only' => ['index']]);
    }

    public function index()
    {
        $data['page_title'] = 'Overtime';
        $role = Auth::user()->hasRole('Super Admin');
        $data['overtime'] = Overtime::with('employee')
        ->when(function ($query) use($role) {
            if (!Auth::user()->hasRole('Super Admin') && !Auth::user()->hasRole('Human Resource Manager') && !Auth::user()->hasRole('Human Resource Staff')) {
                return $query->where('employee_id', getEmployeID());
            }
        })->orderBy('date','desc')->get();
        return view('overtime.index', $data);
    }
    public function indexManager()
    {
        $data['page_title'] = 'Overtime';
        $role = Auth::user()->hasRole('Super Admin');
        $data['overtime'] = Overtime::with('employee')
        ->when(function ($query) use($role) {
            if ($role == false) {
                return $query->where('employee_id', getEmployeID());
            }
        })->orderBy('date','desc')->get();
        return view('overtime.index-manager', $data);
    }
    public function create()
    {
        $data['page_title'] = 'Create Overtime';
        $data['employee'] = Employe::orderBy('first_name','asc')->get();
        return view('overtime.create', $data);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'date' => 'required',
                'subject' => 'required',
                'start_time' => 'required',
                'end_time' => 'required',
                'description' => 'required',
            ]);
            $check = Overtime::where('employee_id',$request->input('employee_id') != null ? $request->input('employee_id') : getEmployeID())->where('date',$request->input('date'))->first();
    
            if (!empty($check)) {
                return response()->json(['failed' => true, 'msg' => 'Sudah memiliki data overtime pada tanggal yang dipilih!']);
            }
            $data = new Overtime();
            $data->employee_id = $request->input('employee_id') != null ? $request->input('employee_id') : getEmployeID();
            $data->date = $request->input('date');
            $data->subject = $request->input('subject');
            $data->start_time = $request->input('start_time');
            $data->end_time = $request->input('end_time');
            $data->description = $request->input('description');
            $data->status = 1;
            $data->save();
    
            return response()->json(['success' => true, 'msg' => 'Data Overtime berhasil disimpan!']);
        } catch (\Throwable $th) {
            return response()->json(['failed' => true, 'msg' => 'Gagal Simpan Data!']);

        }
    }
    public function edit($id)
    {
        $data['page_title'] = 'Edit Overtime';
        $data['overtime'] = Overtime::find($id);
        $data['employee'] = Employe::orderBy('first_name','asc')->get();
        return view('overtime.edit', $data);
    }
    public function update(Request $request,$id)
    {
        try {
            $request->validate([
                'date' => 'required',
                'subject' => 'required',
                'start_time' => 'required',
                'end_time' => 'required',
                'description' => 'required',
            ]);
            $check = Overtime::where('id','!=',$id)->where('employee_id',$request->input('employee_id') != null ? $request->input('employee_id') : getEmployeID())->where('date',$request->input('date'))->first();
    
            if (!empty($check)) {
                return response()->json(['failed' => true, 'msg' => 'Sudah memiliki data overtime pada tanggal yang dipilih!']);
            }

            $data = Overtime::find($id);
            $data->employee_id = $request->input('employee_id') != null ? $request->input('employee_id') : getEmployeID();
            $data->date = $request->input('date');
            $data->subject = $request->input('subject');
            $data->start_time = $request->input('start_time');
            $data->end_time = $request->input('end_time');
            $data->description = $request->input('description');
            $data->status = 1;
            $data->save();
    
            return response()->json(['success' => true, 'msg' => 'Data Overtime berhasil disimpan!']);
        } catch (\Throwable $th) {
            return response()->json(['failed' => true, 'msg' => 'Gagal Simpan Data!']);

        }
    }

    public function approve($id)
    {
        try {
            $data = Overtime::find($id);
            $data->status = 2;
            $data->datetime_approve = date('Y-m-d H:i:s');
            $data->approve_by = Auth::user()->name;
            $data->save();
    
            return response()->json(['success' => true, 'msg' => 'Data Overtime berhasil disimpan!']);
        } catch (\Throwable $th) {
            return response()->json(['failed' => true, 'msg' => 'Gagal Simpan Data!']);

        }
    }

    public function delete(Request $request,$id)
    {
        try {
            $data = Overtime::find($id);
            $data->delete();
    
            return response()->json(['success' => true, 'msg' => 'Data Overtime berhasil disimpan!']);
        } catch (\Throwable $th) {
            return response()->json(['failed' => true, 'msg' => 'Gagal Simpan Data!']);

        }
    }
}
