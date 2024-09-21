<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:list-attendance', ['only' => ['index']]);
    }

    public function index()
    {
        $data['page_title'] = 'Attendance';
        $data['attendance'] = Attendance::with('employee')->orderBy('date','desc')->get();
        return view('attendance.index', $data);
    }

}
