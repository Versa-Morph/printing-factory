<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('homepage');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function homepage()
    {
        return view('homepage.index1');
    }

    public function homepageRole()
    {
        return view('homepage.index');
    }

    public function formCustomer()
    {
        $data['employes'] = Employe::orderBy('employee_code','asc')->get();

        return view('crm.customers.form',$data);
    }

    
    public function redirectPage(){
        if (Auth::check() == true) {
            return view('redirectPage');
        }else{
            return redirect('/login');
        }
    }

    public function updateDashboardView(Request $request){
        try {
            $data = User::find(Auth::user()->id);
            $data->dashboard_view = $request->view;
            $data->save();

            return response()->json([
                'msg' => 'suceess'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'msg' => 'gagal'
            ]);
        }
    }
}
