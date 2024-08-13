<?php
namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:list-customer', ['only' => ['index']]);
        $this->middleware('permission:create-customer', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-customer', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-customer', ['only' => ['delete']]);
    }

    public function index()
    {
        $data['page_title'] = 'Customers';
        return view('crm.customers.index', $data);
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = Customer::orderBy('created_at', 'desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row) {
                    $editUrl = route('customer-edit', $row->id);
                    $deleteUrl = route('customer-delete', $row->id);
                    return "<div class='dropdown'>
                                <button class='btn btn-light btn-sm dropdown-toggle' type='button' data-bs-toggle='dropdown' aria-expanded='true'>
                                    <i class='uil uil-ellipsis-h'></i>
                                </button>
                                <ul class='dropdown-menu dropdown-menu-end'>
                                    <li><a class='dropdown-item edit' href='$editUrl'>Edit</a></li>
                                    <li><a class='dropdown-item delete' href='javascript:void(0);' data-url='$deleteUrl'>Delete</a></li>
                                </ul>
                            </div>";
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function create()
    {
        $data['page_title'] = 'Add Customer';
        return view('crm.customers.create', $data);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'company_name' => 'required|string|max:255',
                'company_code' => 'required|string|max:50',
                'company_phone_number' => 'required|string|max:20',
                'company_address' => 'required|string',
                'company_email' => 'required|string|email|max:255',
                'pic_name' => 'required|string|max:255',
                'pic_phone_number' => 'required|string|max:20',
                'pic_email' => 'required|string|email|max:255',
                'referral_code' => 'required|string|max:255',
                'company_npwp' => 'nullable|string|max:50',
                'billing_address' => 'nullable|string',
                'shipping_address' => 'nullable|string',
                'company_status' => 'required|in:potensial,customer',
            ]);

            $data = new Customer();
            $data->company_name = $request->company_name;
            $data->company_code = $request->company_code;
            $data->company_phone_number = $request->company_phone_number;
            $data->company_address = $request->company_address;
            $data->company_email = $request->company_email;
            $data->pic_name = $request->pic_name;
            $data->pic_phone_number = $request->pic_phone_number;
            $data->pic_email = $request->pic_email;
            $data->referral_code = $request->referral_code;
            $data->company_npwp = $request->company_npwp;
            $data->billing_address = $request->billing_address;
            $data->shipping_address = $request->shipping_address;
            $data->company_status = $request->company_status;
            $data->created_by = Auth::user()->name;
            $data->save();

            return response()->json(['success' => true, 'msg' => 'Customer successfully added!']);
        } catch (\Throwable $th) {
            return response()->json(['failed' => true, 'msg' => 'Failed to save customer data!']);
        }
    }

    public function edit($id)
    {
        $data['page_title'] = 'Edit Customer';
        $data['customer'] = Customer::find($id);
        return view('crm.customers.edit', $data);
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'company_name' => 'required|string|max:255',
                'company_code' => 'required|string|max:50',
                'company_phone_number' => 'required|string|max:20',
                'company_address' => 'required|string',
                'company_email' => 'required|string|email|max:255',
                'pic_name' => 'required|string|max:255',
                'pic_phone_number' => 'required|string|max:20',
                'pic_email' => 'required|string|email|max:255',
                'referral_code' => 'required|string|max:255',
                'company_npwp' => 'nullable|string|max:50',
                'billing_address' => 'nullable|string',
                'shipping_address' => 'nullable|string',
                'company_status' => 'required|in:potensial,customer',
            ]);

            $data = Customer::find($id);
            $data->company_name = $request->company_name;
            $data->company_code = $request->company_code;
            $data->company_phone_number = $request->company_phone_number;
            $data->company_address = $request->company_address;
            $data->company_email = $request->company_email;
            $data->pic_name = $request->pic_name;
            $data->pic_phone_number = $request->pic_phone_number;
            $data->pic_email = $request->pic_email;
            $data->referral_code = $request->referral_code;
            $data->company_npwp = $request->company_npwp;
            $data->billing_address = $request->billing_address;
            $data->shipping_address = $request->shipping_address;
            $data->company_status = $request->company_status;
            $data->updated_by = Auth::user()->name;
            $data->save();

            return response()->json(['success' => true, 'msg' => 'Customer successfully updated!']);
        } catch (\Throwable $th) {
            return response()->json(['failed' => true, 'msg' => 'Failed to update customer data!']);
        }
    }

    public function delete($id)
    {
        $customer = Customer::find($id);
        if ($customer) {
            $customer->delete();
            return response()->json(['success' => 'Customer successfully deleted!']);
        }
        return response()->json(['error' => 'Customer not found']);
    }
}
