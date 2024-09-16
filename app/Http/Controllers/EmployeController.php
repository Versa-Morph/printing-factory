<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class EmployeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:list-employe', ['only' => ['index']]);
        $this->middleware('permission:create-employe', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-employe', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-employe', ['only' => ['delete']]);
    }

    public function index()
    {
        $data['page_title'] = 'Employe';
        return view('employe.index', $data);
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = Employe::orderBy('created_at','desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $editUrl = route('employe-edit', $row->id);
                    $deleteUrl = route('employe-delete', $row->id);
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
        $data['page_title'] = 'Create Employe';
        $data['users'] = User::orderBy('name','asc')->get();

        return view('employe.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'user_id'                   => 'nullable|exists:users,id',
                'employee_code'             => 'required|string|max:255',
                'first_name'                => 'required|string|max:255',
                'last_name'                 => 'nullable|string|max:255',
                'email'                     => 'required|string|email|max:255|unique:employes,email',
                'phone'                     => 'nullable|string|max:20',
                'date_of_birth'             => 'nullable|date',
                'gender'                    => 'nullable|string',
                'address'                   => 'nullable|string',
                'hire_date'                 => 'required|date',
                'status_employe'                    => 'required|string|max:50',
                'profile_picture'           => 'nullable|string',
                'ktp_number'                => 'nullable|string|max:50',
                'ktp_file'                  => 'nullable|string',
                'npwp_number'               => 'nullable|string|max:50',
                'npwp_file'                 => 'nullable|string',
                'bpjs_kesehatan_number'     => 'nullable|string|max:50',
                'bpjs_kesehatan_file'       => 'nullable|string',
                'bpjs_ketenagakerjaan_number' => 'nullable|string|max:50',
                'bpjs_ketenagakerjaan_file' => 'nullable|string',
                'family_card_number'        => 'nullable|string|max:50',
                'family_card_file'          => 'nullable|string',
                'marital_status'            => 'nullable|string|max:50',
                'status_attendance'         => 'required|in:mobile,office',
            ]);
    
            $employe = new Employe();
            $employe->user_id = $request->input('user_id');
            $employe->employee_code = $request->input('employee_code');
            $employe->first_name = $request->input('first_name');
            $employe->last_name = $request->input('last_name');
            $employe->email = $request->input('email');
            $employe->phone = $request->input('phone');
            $employe->date_of_birth = $request->input('date_of_birth');
            $employe->gender = $request->input('gender');
            $employe->address = $request->input('address');
            $employe->hire_date = $request->input('hire_date');
            $employe->status = $request->input('status_employe');

            if ($request->hasFile('profile_picture')) {
                $image = $request->file('profile_picture');
                $name = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('assets/img/profile_picture/');
                $image->move($destinationPath, $name);
                $employe->profile_picture = $name;
            }

            $employe->ktp_number = $request->input('ktp_number');
            if ($request->hasFile('ktp_file')) {
                $image = $request->file('ktp_file');
                $name = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('assets/img/ktp_file/');
                $image->move($destinationPath, $name);
                $employe->ktp_file = $name;
            }
            
            $employe->npwp_number = $request->input('npwp_number');

            $dokumenNpwp = $request->file('npwp_file');

            if ($dokumenNpwp != null) {
                $documentPath = public_path('file/npwp/');
                $documentName = $dokumenNpwp->getClientOriginalName();
                $i = 1;
                while (file_exists($documentPath . $documentName)) {
                    $documentName = pathinfo($dokumenNpwp->getClientOriginalName(), PATHINFO_FILENAME) . "($i)." . $dokumenNpwp->getClientOriginalExtension();
                    $i++;
                }
                $dokumenNpwp->move($documentPath, $documentName);
                $employe->npwp_file = $documentName;
            }


            $employe->bpjs_kesehatan_number = $request->input('bpjs_kesehatan_number');
            
            $dokumenBPJSKesehatan = $request->file('bpjs_kesehatan_file');

            if ($dokumenBPJSKesehatan != null) {
                $documentPath = public_path('file/bpjs/kesehatan/');
                $documentName = $dokumenBPJSKesehatan->getClientOriginalName();
                $i = 1;
                while (file_exists($documentPath . $documentName)) {
                    $documentName = pathinfo($dokumenBPJSKesehatan->getClientOriginalName(), PATHINFO_FILENAME) . "($i)." . $dokumenBPJSKesehatan->getClientOriginalExtension();
                    $i++;
                }
                $dokumenBPJSKesehatan->move($documentPath, $documentName);
                $employe->bpjs_kesehatan_file = $documentName;
            }

            $employe->bpjs_ketenagakerjaan_number = $request->input('bpjs_ketenagakerjaan_number');

            $dokumenBPJSKetenagakerjaan = $request->file('bpjs_ketenagakerjaan_file');

            if ($dokumenBPJSKetenagakerjaan != null) {
                $documentPath = public_path('file/bpjs/ketenagakerjaan/');
                $documentName = $dokumenBPJSKetenagakerjaan->getClientOriginalName();
                $i = 1;
                while (file_exists($documentPath . $documentName)) {
                    $documentName = pathinfo($dokumenBPJSKetenagakerjaan->getClientOriginalName(), PATHINFO_FILENAME) . "($i)." . $dokumenBPJSKetenagakerjaan->getClientOriginalExtension();
                    $i++;
                }
                $dokumenBPJSKetenagakerjaan->move($documentPath, $documentName);
                $employe->bpjs_ketenagakerjaan_file = $documentName;
            }

            $employe->family_card_number = $request->input('family_card_number');

            $dokumenFamilyCard = $request->file('family_card_file');

            if ($dokumenFamilyCard != null) {
                $documentPath = public_path('file/family_card/');
                $documentName = $dokumenFamilyCard->getClientOriginalName();
                $i = 1;
                while (file_exists($documentPath . $documentName)) {
                    $documentName = pathinfo($dokumenFamilyCard->getClientOriginalName(), PATHINFO_FILENAME) . "($i)." . $dokumenFamilyCard->getClientOriginalExtension();
                    $i++;
                }
                $dokumenFamilyCard->move($documentPath, $documentName);
                $employe->family_card_file = $documentName;
            }


            $employe->marital_status = $request->input('marital_status');
            $employe->status_attendance = $request->input('status_attendance');
            $employe->save();
    
            return response()->json(['success' => true, 'msg' => 'Employee data saved successfully!']);
        } catch (\Throwable $th) {
            return response()->json(['failed' => true, 'msg' => 'Failed to save data!']);
        }
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Employe $employe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['page_title'] = 'Edit Employe';
        $data['users'] = User::orderBy('name','asc')->get();
        $data['employe'] = Employe::find($id);

        return view('employe.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'user_id'                   => 'nullable|exists:users,id',
                'employee_code'             => 'required|string|max:255',
                'first_name'                => 'required|string|max:255',
                'last_name'                 => 'nullable|string|max:255',
                'email'                     => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    Rule::unique('employes', 'email')->ignore($id) // Ignore the email for the current record
                ],
                'phone'                     => 'nullable|string|max:20',
                'date_of_birth'             => 'nullable|date',
                'gender'                    => 'nullable|string',
                'address'                   => 'nullable|string',
                'hire_date'                 => 'required|date',
                'status_employe'                    => 'required|string|max:50',
                'profile_picture'           => 'nullable|string',
                'ktp_number'                => 'nullable|string|max:50',
                'ktp_file'                  => 'nullable|string',
                'npwp_number'               => 'nullable|string|max:50',
                'npwp_file'                 => 'nullable|string',
                'bpjs_kesehatan_number'     => 'nullable|string|max:50',
                'bpjs_kesehatan_file'       => 'nullable|string',
                'bpjs_ketenagakerjaan_number' => 'nullable|string|max:50',
                'bpjs_ketenagakerjaan_file' => 'nullable|string',
                'family_card_number'        => 'nullable|string|max:50',
                'family_card_file'          => 'nullable|string',
                'marital_status'            => 'nullable|string|max:50',
                'status_attendance'         => 'required|in:mobile,office',
            ]);
    
            $employe = Employe::find($id);
            $employe->user_id = $request->input('user_id');
            $employe->employee_code = $request->input('employee_code');
            $employe->first_name = $request->input('first_name');
            $employe->last_name = $request->input('last_name');
            $employe->email = $request->input('email');
            $employe->phone = $request->input('phone');
            $employe->date_of_birth = $request->input('date_of_birth');
            $employe->gender = $request->input('gender');
            $employe->address = $request->input('address');
            $employe->hire_date = $request->input('hire_date');
            $employe->status = $request->input('status_employe');

            if ($request->hasFile('profile_picture')) {
                $image = $request->file('profile_picture');
                $name = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('assets/img/profile_picture/');
                $image->move($destinationPath, $name);
                $employe->profile_picture = $name;
            }

            $employe->ktp_number = $request->input('ktp_number');
            if ($request->hasFile('ktp_file')) {
                $image = $request->file('ktp_file');
                $name = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('assets/img/ktp_file/');
                $image->move($destinationPath, $name);
                $employe->ktp_file = $name;
            }
            
            $employe->npwp_number = $request->input('npwp_number');

            $dokumenNpwp = $request->file('npwp_file');

            if ($dokumenNpwp != null) {
                $documentPath = public_path('file/npwp/');
                $documentName = $dokumenNpwp->getClientOriginalName();
                $i = 1;
                while (file_exists($documentPath . $documentName)) {
                    $documentName = pathinfo($dokumenNpwp->getClientOriginalName(), PATHINFO_FILENAME) . "($i)." . $dokumenNpwp->getClientOriginalExtension();
                    $i++;
                }
                $dokumenNpwp->move($documentPath, $documentName);
                $employe->npwp_file = $documentName;
            }


            $employe->bpjs_kesehatan_number = $request->input('bpjs_kesehatan_number');
            
            $dokumenBPJSKesehatan = $request->file('bpjs_kesehatan_file');

            if ($dokumenBPJSKesehatan != null) {
                $documentPath = public_path('file/bpjs/kesehatan/');
                $documentName = $dokumenBPJSKesehatan->getClientOriginalName();
                $i = 1;
                while (file_exists($documentPath . $documentName)) {
                    $documentName = pathinfo($dokumenBPJSKesehatan->getClientOriginalName(), PATHINFO_FILENAME) . "($i)." . $dokumenBPJSKesehatan->getClientOriginalExtension();
                    $i++;
                }
                $dokumenBPJSKesehatan->move($documentPath, $documentName);
                $employe->bpjs_kesehatan_file = $documentName;
            }

            $employe->bpjs_ketenagakerjaan_number = $request->input('bpjs_ketenagakerjaan_number');

            $dokumenBPJSKetenagakerjaan = $request->file('bpjs_ketenagakerjaan_file');

            if ($dokumenBPJSKetenagakerjaan != null) {
                $documentPath = public_path('file/bpjs/ketenagakerjaan/');
                $documentName = $dokumenBPJSKetenagakerjaan->getClientOriginalName();
                $i = 1;
                while (file_exists($documentPath . $documentName)) {
                    $documentName = pathinfo($dokumenBPJSKetenagakerjaan->getClientOriginalName(), PATHINFO_FILENAME) . "($i)." . $dokumenBPJSKetenagakerjaan->getClientOriginalExtension();
                    $i++;
                }
                $dokumenBPJSKetenagakerjaan->move($documentPath, $documentName);
                $employe->bpjs_ketenagakerjaan_file = $documentName;
            }

            $employe->family_card_number = $request->input('family_card_number');

            $dokumenFamilyCard = $request->file('family_card_file');

            if ($dokumenFamilyCard != null) {
                $documentPath = public_path('file/family_card/');
                $documentName = $dokumenFamilyCard->getClientOriginalName();
                $i = 1;
                while (file_exists($documentPath . $documentName)) {
                    $documentName = pathinfo($dokumenFamilyCard->getClientOriginalName(), PATHINFO_FILENAME) . "($i)." . $dokumenFamilyCard->getClientOriginalExtension();
                    $i++;
                }
                $dokumenFamilyCard->move($documentPath, $documentName);
                $employe->family_card_file = $documentName;
            }


            $employe->marital_status = $request->input('marital_status');
            $employe->status_attendance = $request->input('status_attendance');
            $employe->save();
    
            return response()->json(['success' => true, 'msg' => 'Employee data saved successfully!']);
        } catch (\Throwable $th) {
            return response()->json(['failed' => true, 'msg' => 'Failed to save data!','error' => $th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        try {
            $employe = Employe::find($id);
            $employe->delete();
    
            return response()->json(['success' => true, 'msg' => 'Employee data deleted successfully!']);
        } catch (\Throwable $th) {
            return response()->json(['failed' => true, 'msg' => 'Failed to delete data!','error' => $th->getMessage()]);
        }
    }
}
