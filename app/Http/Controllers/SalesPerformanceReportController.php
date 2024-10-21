<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Quotation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class SalesPerformanceReportController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    //     $this->middleware('permission:list-quotation', ['only' => ['index']]);
    //     $this->middleware('permission:create-quotation', ['only' => ['create', 'store']]);
    //     $this->middleware('permission:edit-quotation', ['only' => ['edit', 'update']]);
    //     $this->middleware('permission:delete-quotation', ['only' => ['delete']]);
    // }

    public function index()
    {
        $data['page_title'] = 'Sales Performance Report';
        
        if (Auth::user()->role == 'sales') {
            // If the user's role is 'sales', they can only see their own accounts
            $quotations = Quotation::where('created_by', Auth::user()->name)->orderBy('created_at', 'desc')->get();
            $orders = Quotation::where('created_by', Auth::user()->name)->where('status','accepted')->orderBy('created_at', 'desc')->get();
            $customers = Customer::wehre('created_by', Auth::user()->name)->where('company_status','customer')->get();

        } else {
            $quotations = Quotation::orderBy('created_at', 'desc')->get();
            $orders = Quotation::orderBy('created_at', 'desc')->get();
            $customers = Customer::orderBy('created_at', 'desc')->get();
        }

        $data['quotations'] = $quotations;

        // Count the quotations
        $data['quotation_count'] = $quotations->count();
        
        // Assuming you have models for Customer and Order
        $data['customer_count'] = $customers->count(); // Replace 'Customer' with your customer model
        $data['order_count'] = $orders->count(); // Replace 'Order' with your order model

        return view('sales.sales-performance-report.index', $data);
    }


    public function getData(Request $request)
    {
        if ($request->ajax()) {
            if (Auth::user()->role == 'sales') {
                // If the user's role is 'sales', they can only see their own accounts
                $data = Quotation::orderBy('created_at', 'desc')
                                ->where('created_by', Auth::user()->name)
                                ->get();
            } else {
                $data = Quotation::orderBy('created_at', 'desc')->get();
            }
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $editUrl = route('quotation-edit', $row->id);
                    $approveUrl = route('quotation-modal-approve', $row->id);
                    $deleteUrl = route('quotation-delete', $row->id);
                    $dropdown = "<div class='dropdown'>
                                    <button class='btn btn-light btn-sm dropdown-toggle' type='button' data-bs-toggle='dropdown' aria-expanded='true'>
                                        <i class='uil uil-ellipsis-h'></i>
                                    </button>
                                    <ul class='dropdown-menu dropdown-menu-end'>
                                        <li><a class='dropdown-item edit' href='$editUrl'>Edit</a></li>
                                        <li><a class='dropdown-item approve view-details' data-id='$row->id'>Approve</a></li>
                                        <li><a class='dropdown-item delete' href='javascript:void(0);' data-url='$deleteUrl'>Delete</a></li>
                                    </ul>
                                </div>";
                    return $dropdown;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
