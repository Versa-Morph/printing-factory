<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
