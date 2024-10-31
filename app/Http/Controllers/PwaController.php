<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\AttendanceDetail;
use App\Models\Employe;
use App\Models\Overtime;
use App\Models\WorkSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PwaController extends Controller
{
    public function loginPwa(){
        $data['page_title'] = 'Login Page';
        return view('pwa.auth.login', $data);
    }


    public function index(){
        if (Auth::check() != true) {
            return redirect()->route('pwa-login');
        }
        if (Auth::user()->hasRole('Super Admin')) {
            Auth::logout();
            return redirect()->route('pwa-login');
        }
        $data['page_title'] = 'Homepage';
        $getEmployeId = Employe::where('user_id',Auth::user()->id)->first();
        $data['shift'] = $this->getShift($getEmployeId->id);
        $data['cekAttendance'] = Attendance::where('employee_id',$getEmployeId->id)->where('date',date('Y-m-d'))->first();
        $data['cekOvertime'] = Overtime::where('employee_id',$getEmployeId->id)->where('date',date('Y-m-d'))->where('status',2)->first();
        return view('pwa.home.index', $data);
    }

    private function getShift($getEmployeId){
        $getShift = WorkSchedule::with('shift')->where('employee_id',$getEmployeId)->where('date',date('Y-m-d'))->first();
        return $getShift->shift ?? null;
    }
    
    public function attend(){
        if (Auth::check() != true) {
            return redirect()->route('pwa-login');
        }
        $data['page_title'] = 'Attendance';
        $dataLocation = checkBlockLocation();
        // dd($dataLocation);
        $data['data_location'] = checkBlockLocation();
        return view('pwa.attend.index', $data);
    }

    public function getJamMasuk($getEmployeId){
        $shift = $this->getShift($getEmployeId->id);
        return $shift->start_time;
    }

    public function storeAttend(Request $request)
    {
        try {
            if (Auth::check() != true) {
                return redirect()->route('pwa-login');
            }
            $type = $request->input('type');
            $base64data = $request->input('image');
            // Menghapus header data base64
            $base64data = preg_replace('#^data:image/\w+;base64,#i', '', $base64data);
    
            // Decode base64 menjadi binary data
            $image = base64_decode($base64data);
    
            // Pastikan decoding berhasil
            if ($image === false) {
                return redirect()->back()->with('error', 'Failed to decode base64 image.');
            }
    
            $imageName = $type.'-'.Auth::user()->id.'-'.time() . '.jpg'; // Nama file bisa disesuaikan dengan kebutuhan
            $destinationPath = public_path('assets/img/attendance/');
            file_put_contents($destinationPath . $imageName, $image);
    
            $getEmployeId = Employe::where('user_id',Auth::user()->id)->first();
            $cekAttendance = Attendance::where('employee_id',$getEmployeId->id)->where('date',date('Y-m-d'))->first();
            if ($cekAttendance != null) {
                $attendance = Attendance::find($cekAttendance->id);
                if ($type == 'clock-in') {
                    $attendance->clock_in = date('H:i:s');
                }elseif ($type == 'clock-out') {
                    $attendance->clock_out = date('H:i:s');
                }elseif ($type == 'break') {
                    $attendance->break_start = date('H:i:s');
                }elseif ($type == 'after-break') {
                    $attendance->break_end = date('H:i:s');
                }elseif ($type == 'overtime-in') {
                    $attendance->overtime_in = date('H:i:s');
                }elseif ($type == 'overtime-out') {
                    $attendance->overtime_out = date('H:i:s');
                }
    
            }else{
                $attendance = new Attendance();
                $attendance->employee_id = $getEmployeId->id;
                $attendance->date = date('Y-m-d');
                if ($type == 'clock-in') {
                    $attendance->clock_in = date('H:i:s');
                }elseif ($type == 'clock-out') {
                    $attendance->clock_out = date('H:i:s');
                }elseif ($type == 'break') {
                    $attendance->break_start = date('H:i:s');
                }elseif ($type == 'after-break') {
                    $attendance->break_end = date('H:i:s');
                }elseif ($type == 'overtime-in') {
                    $attendance->overtime_in = date('H:i:s');
                }elseif ($type == 'overtime-out') {
                    $attendance->overtime_out = date('H:i:s');
                }
                $attendance->status = date('H:i:s') > $this->getJamMasuk($getEmployeId) ? 'late' : 'present'; 
            }
            
            if ($attendance->save()) {
                $cekAttendanceDetail = AttendanceDetail::where('attendance_id',$attendance->id)->where('type',$type)->first();
                if ($cekAttendanceDetail != null) {
                    $attendDetail = AttendanceDetail::find($cekAttendanceDetail->id);
                }else{
                    $attendDetail = new AttendanceDetail();
                    $attendDetail->attendance_id = $attendance->id;
                    $attendDetail->type = $type;
                    $attendDetail->photo = $imageName; 
                    $attendDetail->reason = !empty($request->note) ? $request->note : null; 
                    $attendDetail->latitude = $request->latitude; 
                    $attendDetail->longitude = $request->longitude; 
                }
                $attendDetail->save(); 
            }
    
            return redirect()->route('pwa-homepage')->with('success', 'Attendance recorded successfully.');
        } catch (\Throwable $th) {
            return redirect()->route('pwa-homepage')->with('failed', 'Attendance failed recorded.');
        }
    }

    public function Logout(){
        Auth::logout();
        return redirect()->route('pwa-login');
    }
}
