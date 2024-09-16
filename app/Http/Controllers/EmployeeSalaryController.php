<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use App\Models\EmployeeSalary;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class EmployeeSalaryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:list-employee-salary', ['only' => ['index']]);
        $this->middleware('permission:create-employee-salary', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-employee-salary', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-employee-salary', ['only' => ['delete']]);
    }

    public function index()
    {
        $data['page_title'] = 'Employee Salary';
        return view('employee-salary.index', $data);
    }

    public function getData(Request $request)
    {
        // if ($request->ajax()) {
            $data = EmployeeSalary::with('employee')->orderBy('created_at','desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $editUrl = route('employee-salary-edit', $row->id);
                    $deleteUrl = route('employee-salary-delete', $row->id);
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
        // }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['page_title'] = 'Create Employe';
        $data['employee'] = Employe::orderBy('first_name','asc')->get();

        return view('employee-salary.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'employee_id'               => 'required|exists:employes,id',
                'payment_method'            => 'required|string|max:255',
                'rekening_number'           => 'required|string|max:255',
                'working_days'              => 'required|integer',
                'overtime_per_hour'         => 'nullable|numeric',
                'additional_overtime'       => 'nullable|numeric',
                'basic_salary'              => 'required|numeric',
                'transportation_incentive'  => 'nullable|numeric',
                'daily_incentive'           => 'nullable|numeric',
                'position_incentive'        => 'nullable|numeric',
                'bpjs_kesehatan_base'       => 'nullable|numeric',
                'bpjs_kesehatan_employee'   => 'nullable|integer',
                'bpjs_kesehatan_employer'   => 'nullable|integer',
                'bpjs_ketenagakerjaan_base' => 'nullable|numeric',
                'bpjs_ketenagakerjaan_employee' => 'nullable|integer',
                'bpjs_ketenagakerjaan_employer' => 'nullable|integer',
            ]);
    
            $employeeSalary = new EmployeeSalary();
            $employeeSalary->employee_id = $request->input('employee_id');
            $employeeSalary->payment_method = $request->input('payment_method');
            $employeeSalary->rekening_number = $request->input('rekening_number');
            $employeeSalary->working_days = $request->input('working_days');
            $employeeSalary->overtime_per_hour = $request->input('overtime_per_hour');
            $employeeSalary->additional_overtime = $request->input('additional_overtime');
            $employeeSalary->basic_salary = $request->input('basic_salary');
            $employeeSalary->transportation_incentive = $request->input('transportation_incentive');
            $employeeSalary->daily_incentive = $request->input('daily_incentive');
            $employeeSalary->position_incentive = $request->input('position_incentive');
            $employeeSalary->bpjs_kesehatan_base = $request->input('bpjs_kesehatan_base');
            $employeeSalary->bpjs_kesehatan_employee = $request->input('bpjs_kesehatan_employee');
            $employeeSalary->bpjs_kesehatan_employer = $request->input('bpjs_kesehatan_employer');
            $employeeSalary->bpjs_ketenagakerjaan_base = $request->input('bpjs_ketenagakerjaan_base');
            $employeeSalary->bpjs_ketenagakerjaan_employee = $request->input('bpjs_ketenagakerjaan_employee');
            $employeeSalary->bpjs_ketenagakerjaan_employer = $request->input('bpjs_ketenagakerjaan_employer');
            
            // Save the record
            $employeeSalary->save();
    
            return response()->json(['success' => true, 'msg' => 'Employee salary data saved successfully!']);
        } catch (\Throwable $th) {
            return response()->json(['failed' => true, 'msg' => 'Failed to save data!', 'error' => $th->getMessage()]);
        }
    }
    

    /**
     * Display the specified resource.
     */
    public function show(EmployeeSalary $employeeSalary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['page_title'] = 'Edit Employe';
        $data['employee'] = Employe::orderBy('first_name','asc')->get();
        $data['employeeSalary'] = EmployeeSalary::find($id);

        return view('employee-salary.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'employee_id'               => 'required|exists:employes,id',
                'payment_method'            => 'required|string|max:255',
                'rekening_number'           => 'required|string|max:255',
                'working_days'              => 'required|integer',
                'overtime_per_hour'         => 'nullable|numeric',
                'additional_overtime'       => 'nullable|numeric',
                'basic_salary'              => 'required|numeric',
                'transportation_incentive'  => 'nullable|numeric',
                'daily_incentive'           => 'nullable|numeric',
                'position_incentive'        => 'nullable|numeric',
                'bpjs_kesehatan_base'       => 'nullable|numeric',
                'bpjs_kesehatan_employee'   => 'nullable|integer',
                'bpjs_kesehatan_employer'   => 'nullable|integer',
                'bpjs_ketenagakerjaan_base' => 'nullable|numeric',
                'bpjs_ketenagakerjaan_employee' => 'nullable|integer',
                'bpjs_ketenagakerjaan_employer' => 'nullable|integer',
            ]);
    
            $employeeSalary = EmployeeSalary::find($id);
            $employeeSalary->employee_id = $request->input('employee_id');
            $employeeSalary->payment_method = $request->input('payment_method');
            $employeeSalary->rekening_number = $request->input('rekening_number');
            $employeeSalary->working_days = $request->input('working_days');
            $employeeSalary->overtime_per_hour = $request->input('overtime_per_hour');
            $employeeSalary->additional_overtime = $request->input('additional_overtime');
            $employeeSalary->basic_salary = $request->input('basic_salary');
            $employeeSalary->transportation_incentive = $request->input('transportation_incentive');
            $employeeSalary->daily_incentive = $request->input('daily_incentive');
            $employeeSalary->position_incentive = $request->input('position_incentive');
            $employeeSalary->bpjs_kesehatan_base = $request->input('bpjs_kesehatan_base');
            $employeeSalary->bpjs_kesehatan_employee = $request->input('bpjs_kesehatan_employee');
            $employeeSalary->bpjs_kesehatan_employer = $request->input('bpjs_kesehatan_employer');
            $employeeSalary->bpjs_ketenagakerjaan_base = $request->input('bpjs_ketenagakerjaan_base');
            $employeeSalary->bpjs_ketenagakerjaan_employee = $request->input('bpjs_ketenagakerjaan_employee');
            $employeeSalary->bpjs_ketenagakerjaan_employer = $request->input('bpjs_ketenagakerjaan_employer');
            
            // Save the record
            $employeeSalary->save();
    
            return response()->json(['success' => true, 'msg' => 'Employee salary data saved successfully!']);
        } catch (\Throwable $th) {
            return response()->json(['failed' => true, 'msg' => 'Failed to save data!', 'error' => $th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        try {
    
            $employeeSalary = EmployeeSalary::find($id);
            $employeeSalary->delete();
    
            return response()->json(['success' => true, 'msg' => 'Employee salary data deleted successfully!']);
        } catch (\Throwable $th) {
            return response()->json(['failed' => true, 'msg' => 'Failed to delete data!', 'error' => $th->getMessage()]);
        }
    }
}
