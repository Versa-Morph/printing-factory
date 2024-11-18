<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\Employe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class PWAAbsenceController extends Controller
{
    public function index()
    {
        $data['page_title'] = 'Absence';
        $role = Auth::user()->hasRole('Super Admin');
        $data['data'] = Absence::when(function ($query) use($role) {
                return $query->where('employee_id', getEmployeID());
        })->orderBy('created_at','desc')->get();
        return view('pwa.absence.index', $data);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'start_date'    => 'required',
                'end_date'      => 'required',
                'leave_type'    => 'required',
                'reason'        => 'required',
                'status'        => 'required',
            ]);
    
            $absence = new Absence();
            $absence->employee_id = getEmployeID();
            $absence->start_date = $request->input('start_date');
            $absence->end_date = $request->input('end_date');
            $absence->leave_type = $request->input('leave_type');
            $absence->reason = $request->input('reason');
            $absence->status = $request->input('status');
            $absence->save();

            session()->flash('success', 'Data Absence berhasil disimpan!');
            return redirect()->back();
        } catch (\Throwable $th) {
            session()->flash('failed', $th->getMessage());
            return redirect()->back();
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'start_date'    => 'required',
                'end_date'      => 'required',
                'leave_type'    => 'required',
                'reason'        => 'required',
                'status'        => 'required',
            ]);
    
            $absence = Absence::find($id);
            $absence->employee_id = getEmployeID();
            $absence->start_date = $request->input('start_date');
            $absence->end_date = $request->input('end_date');
            $absence->leave_type = $request->input('leave_type');
            $absence->reason = $request->input('reason');
            $absence->status = $request->input('status');
            $absence->save();

            session()->flash('success', 'Data Absence berhasil disimpan!');
            return redirect()->back();
        } catch (\Throwable $th) {
            session()->flash('failed', $th->getMessage());
            return redirect()->back();
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
