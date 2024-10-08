<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use App\Models\Shift;
use App\Models\WorkSchedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class WorkScheduleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:list-work-schedule', ['only' => ['index']]);
    }

    public function index()
    {
        $data['page_title'] = 'Work Schedule';
        return view('work-schedule.index', $data);

    }

    public function getDataIndex(Request $request)
    {
        if ($request->ajax()) {
            $data = WorkSchedule::join('shifts', 'work_schedules.shift_id', '=', 'shifts.id')
                ->join('employes', 'work_schedules.employee_id', '=', 'employes.id')
                ->select('work_schedules.*', 'shifts.name as shift_name', 'shifts.start_time', 'shifts.end_time', 'employes.first_name as employee_firstname', 'employes.last_name as employee_lastname')
                ->orderBy('work_schedules.created_at', 'asc')
                ->where('work_schedules.employee_id', Auth::user()->employee ? Auth::user()->employee->id : null)
                ->when(!Auth::user()->employee, function ($query) {
                    return $query->whereRaw('1 = 0'); // Menambahkan kondisi agar tidak ada hasil jika tidak ada employee
                })
                ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('employee_name', function($row){
                    return $row->employee_firstname. ' ' . $row->employee_lastname;
                })
                ->addColumn('shift', function($row){
                    return $row->shift_name;
                })
                ->addColumn('clock_in', function($row){
                    return "<span class='badge bg-success'>{$row->start_time}</span>";
                })
                ->addColumn('clock_out', function($row){
                    return "<span class='badge bg-danger'>{$row->end_time}</span>";
                })
                ->rawColumns(['clock_in', 'clock_out', 'employee_name']) // Include employee_checklist as raw HTML
                ->make(true);
        }
    }

    public function hrWorkScheduleIndex()
    {
        $data['page_title'] = 'Work Schedule';
        return view('human-resource.work-schedule.index', $data);
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = WorkSchedule::join('shifts', 'work_schedules.shift_id', '=', 'shifts.id')
                ->join('employes', 'work_schedules.employee_id', '=', 'employes.id')
                ->select('work_schedules.*', 'shifts.name as shift_name', 'shifts.start_time', 'shifts.end_time', 'employes.first_name as employee_firstname', 'employes.last_name as employee_lastname')
                ->orderBy('work_schedules.created_at', 'asc')
                ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('employee_name', function($row){
                    return $row->employee_firstname. ' ' . $row->employee_lastname;
                })
                ->addColumn('shift', function($row){
                    return $row->shift_name;
                })
                ->addColumn('clock_in', function($row){
                    return "<span class='badge bg-success'>{$row->start_time}</span>";
                })
                ->addColumn('clock_out', function($row){
                    return "<span class='badge bg-danger'>{$row->end_time}</span>";
                })
                ->addColumn('action', function($row){
                    $editUrl = route('hr-work-schedule-edit', $row->id);
                    $deleteUrl = route('hr-work-schedule-delete', $row->id);
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
                ->addColumn('employee_checklist', function($row) {
                    return "
                        <div class='demo-checkbox'>
                            <input name='employee[]' type='checkbox' value='{$row->employee_id}' class='filled-in' id='employee-{$row->employee_id}'>
                            <label for='employee-{$row->employee_id}' style='height: 0px; min-width: 0;'></label>
                        </div>";
                })
                ->rawColumns(['clock_in', 'clock_out', 'action', 'employee_checklist', 'employee_name']) // Include employee_checklist as raw HTML
                ->make(true);
        }
    }


    public function create()
    {
        $data['page_title'] = 'Tambah Work Schedule';
        $data['employes'] = Employe::orderBy('employee_code','asc')->get();
        $data['shifts'] = Shift::orderBy('name','asc')->get();

        return view('human-resource.work-schedule.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validasi input
            $request->validate([
                'employee'   => 'required|array',
                'date'       => 'required|date',
                'end_date'   => 'required|date|after_or_equal:date',
                'shift_id'   => 'required',
            ]);

            $startDate = Carbon::parse($request->input('date'));
            $endDate = Carbon::parse($request->input('end_date'));

            foreach ($request->input('employee') as $employee_id) {
                $currentDate = $startDate->copy();

                // Iterasi setiap tanggal dari startDate hingga endDate
                while ($currentDate->lte($endDate)) {
                    // Cek apakah sudah ada data WorkSchedule untuk employee_id dan currentDate
                    $existingSchedule = WorkSchedule::where('employee_id', $employee_id)
                        ->where('date', $currentDate->toDateString())
                        ->where('shift_id', $request->input('shift_id'))
                        ->exists();

                    if ($existingSchedule) {
                        // Jika sudah ada, jangan simpan dan teruskan ke tanggal berikutnya
                        return response()->json(['failed' => true, 'msg' => 'Work schedule sudah ada untuk tanggal tersebut!']);
                    }

                    // Jika tidak ada, maka simpan data baru
                    $work_schedule = new WorkSchedule();
                    $work_schedule->employee_id = $employee_id;
                    $work_schedule->date = $currentDate->toDateString();
                    $work_schedule->shift_id = $request->input('shift_id');
                    $work_schedule->assigned_by = auth()->user()->name;
                    $work_schedule->save();

                    // Tambahkan 1 hari ke currentDate
                    $currentDate->addDay();
                }
            }

            return response()->json(['success' => true, 'msg' => 'Data Work Schedule berhasil disimpan!']);
        } catch (\Throwable $th) {
            return response()->json(['failed' => true, 'msg' => 'Gagal Simpan Data!']);
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(WorkSchedule $workSchedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['page_title'] = 'Edit Work Schedule';
        $data['work_schedule'] = WorkSchedule::find($id);
        $data['employes'] = Employe::orderBy('employee_code','asc')->get();
        $data['shifts'] = Shift::orderBy('name','asc')->get();

        return view('human-resource.work-schedule.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'shift_id'      => 'required',
            ]);

            $work_schedule = WorkSchedule::find($id);
            $work_schedule->shift_id = $request->input('shift_id');
            $work_schedule->assigned_by = auth()->user()->name;
            $work_schedule->save();

            return response()->json(['success' => true, 'msg' => 'Data Work Schedule berhasil diedit!']);
        } catch (\Throwable $th) {
            return response()->json(['failed' => true, 'msg' => 'Gagal Simpan Data!']);
        }
    }

    public function delete($id)
    {
        $workSchedule = WorkSchedule::find($id);
        if ($workSchedule) {
            $workSchedule->delete();
            return response()->json(['success' => 'Data Work Schedule berhasil dihapus!']);
        }
        return response()->json(['error' => 'Data Work Schedule tidak ditemukan']);
    }

    public function deleteChecklist(Request $request)
    {
        $employeeIds = $request->input('employee_ids');

        if ($employeeIds) {
            WorkSchedule::whereIn('id', $employeeIds)->delete();
            return response()->json(['success' => 'Selected work schedules have been deleted successfully!']);
        }

        return response()->json(['error' => 'No records selected for deletion!']);
    }

}
