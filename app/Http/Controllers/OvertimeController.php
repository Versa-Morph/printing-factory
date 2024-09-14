<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OvertimeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:list-attendance', ['only' => ['index']]);
    }

    public function index()
    {
        $data['page_title'] = 'Attendance';
        return view('attendance.index', $data);
    }
}
