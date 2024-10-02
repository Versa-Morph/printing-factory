<?php

use App\Models\Employe;
use Illuminate\Support\Facades\Auth;

if (!function_exists('getEmployeID')) {
    function getEmployeID()
    {
        $getEmployeId = Employe::where('user_id',Auth::user()->id)->first();
        if ($getEmployeId != null) {
            return $getEmployeId->id;
        }else{
            return 0;
        }
    }
}

if (!function_exists('checkBlockLocation')) {
    function checkBlockLocation()
    {
        $cek = Employe::with('statusAttendance')->where('user_id',Auth::user()->id)->first();
        if ($cek != null) {
            if ($cek->statusAttendance->status == 1) {
                $data = [
                    'data_location' => $cek->statusAttendance,
                    'status' => 'blocking',
                ];
                return $data;
            }else{
                $data = [
                    'data_location' => $cek->statusAttendance,
                    'status' => 'not blocking',
                ];
                return $data;
            }
        }else{
            return 'err blocking';
        }
    }
}

if (!function_exists('checkStatusLogin')) {
    function checkStatusLogin()
    {
        $cek = Employe::where('user_id',Auth::user()->id)->first();
        if ($cek != null) {
            if ($cek->status == 'active') {
                return 'allow';
            }else{
                return 'not allow';
            }
        }else{
            return 'not allow';
        }
    }
}
