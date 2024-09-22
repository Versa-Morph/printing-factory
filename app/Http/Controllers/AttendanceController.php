<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:list-attendance', ['only' => ['index']]);
    }
    public function getIdEmploye(){
        $role = Auth::user()->hasRole('Super Admin');
        if ($role == false) {
            $getEmployeId = Employe::where('user_id',Auth::user()->id)->first()->id;
        }else{
            $getEmployeId = null;
        }
        return $getEmployeId;
    }

    public function index()
    {
        $data['page_title'] = 'Attendance';
        $role = Auth::user()->hasRole('Super Admin');
        $getEmployeId = $this->getIdEmploye();
        // dd($role);
        $data['attendance'] = Attendance::with('employee')
        ->when(function ($query) use($getEmployeId,$role) {
            if ($role == false) {
                return $query->where('employee_id', $getEmployeId);
            }
        })->orderBy('date','desc')->get();
        return view('attendance.index', $data);
    }

}
