<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OvertimeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:list-overtime', ['only' => ['index']]);
    }

    public function index()
    {
        $data['page_title'] = 'Overtime';
        return view('overtime.index', $data);
    }
}
