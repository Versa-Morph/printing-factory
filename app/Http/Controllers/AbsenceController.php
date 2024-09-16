<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AbsenceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:list-absence', ['only' => ['index']]);
    }

    public function index()
    {
        $data['page_title'] = 'Absence';
        return view('absence.index', $data);
    }
}
