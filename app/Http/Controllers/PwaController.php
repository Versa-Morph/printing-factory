<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PwaController extends Controller
{
    public function index(){
        $data['page_title'] = 'Homepage';
        return view('pwa.home.index', $data);
    }
}
