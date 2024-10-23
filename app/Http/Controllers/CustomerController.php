<?php
namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Employe;
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
            $data = Customer::orderBy('created_at', 'desc')->where('company_status','customer')->get();
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

    function generateReferralCode($length = 8) {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
    
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
    
        return strtoupper($randomString);
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
            $data->referral_code = $this->generateReferralCode();
            $data->company_status = 'potensial';
            $data->created_by = Auth::user()->name;
            $data->save();

            return response()->json(['success' => true, 'msg' => 'Customer successfully added!']);
        } catch (\Throwable $th) {
            return response()->json(['failed' => true, 'msg' => 'Failed to save customer data!']);
        }
    }

    public function storeFormCustomer(Request $request)
    {
        // dd($request->all());
        try {
            $request->validate([
                'company_name'          => 'required|string|max:255',
                'company_code'          => 'required|string|max:50',
                'company_phone_number'  => 'required|string|max:20',
                'company_address'       => 'required|string',
                'company_email'         => 'required|string|email|max:255',

                'pic_name'              => 'required|string|max:255',
                'pic_phone_number'      => 'required|string|max:20',
                'pic_email'             => 'required|string|email|max:255',
                'referal_code'          => 'required|string|max:20',
            ]);

            // Check if the referral code exists in the Employe table
            $employe = Employe::where('employee_code', $request->referal_code)->first();

            if (!$employe) {
                return redirect()->back()->with('failed', 'Referral Code tidak ditemukan, silakan masukkan referral code yang valid.');
            }

            // If the referral code exists, proceed with saving the customer data
            $data = new Customer();
            $data->company_name = $request->company_name;
            $data->company_code = $request->company_code;
            $data->company_phone_number = $request->company_phone_number;
            $data->company_address = $request->company_address;
            $data->company_email = $request->company_email;
            $data->pic_name = $request->pic_name;
            $data->pic_phone_number = $request->pic_phone_number;
            $data->pic_email = $request->pic_email;
            $data->referral_code = $request->referal_code;
            $data->company_status = $request->company_status;
            $data->created_by = Auth::user()->name;
            $data->save();

            return redirect()->back()->with('success', 'Data Customer Telah Dibuat');
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'Data Customer Gagal Dibuat');
        }
    }

    public function checkReferralCode(Request $request)
    {
        $referalCode = $request->referal_code;
        $isValid = Employe::where('employee_code', $referalCode)->exists(); // Cek keberadaan referral code di tabel karyawan (Employee)
    
        if ($isValid) {
            return response()->json(['valid' => true]);
        } else {
            return response()->json(['valid' => false]);
        }
    }



    public function storeForm(Request $request)
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

    public function changeCustomerStatus($id){
        try {
            $data = Customer::find($id);
            if (!empty($data)) {
                $data->company_status = 'customer';
                $data->status_changed_at = date('Y-m-d H:i:s');
                $data->save();
            }else{
                return response()->json([
                    'msg' => 'failed',
                    'reason' => 'no data exist'
                ]);
            }

            return response()->json([
                'msg' => 'success',
                'data' => $data
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'msg' => 'failed',
                'reason' => $th->getMessage()
            ]);
        }
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

    public function indexLeads()
    {
        $data['page_title'] = 'Leads Customers';
        return view('crm.leads-customers.index', $data);
    }

    public function getDataLeads(Request $request)
    {
        if ($request->ajax()) {

            if (Auth::user()->role == 'sales') {
                // If the user's role is 'sales', they can only see their own accounts
                $data = Customer::orderBy('created_at', 'desc')
                                ->where('created_by', Auth::user()->name)
                                ->get();
            } else {
                // For other roles, they can see all accounts
                $data = Customer::orderBy('created_at', 'desc')->get();
            }
            
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row) {
                    $editUrl = route('leads-customer-edit', $row->id);
                    $deleteUrl = route('leads-customer-delete', $row->id);
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

    public function createLeads()
    {
        $data['page_title'] = 'Add Customer';
        return view('crm.leads-customers.create', $data);
    }


    public function storeLeads(Request $request)
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
            $data->referral_code = $this->generateReferralCode();
            $data->company_status = 'potensial';
            $data->created_by = Auth::user()->name;
            $data->save();

            return response()->json(['success' => true, 'msg' => 'Customer successfully added!']);
        } catch (\Throwable $th) {
            return response()->json(['failed' => true, 'msg' => 'Failed to save customer data!']);
        }
    }

    public function editLeads($id)
    {
        $data['page_title'] = 'Edit Customer';
        $data['customer'] = Customer::find($id);
        return view('crm.leads-customers.edit', $data);
    }

    public function updateLeads(Request $request, $id)
    {
        try {
            $request->validate([
                'company_name'          => 'required|string|max:255',
                'company_code'          => 'required|string|max:50',
                'company_phone_number'  => 'required|string|max:20',
                'company_address'       => 'required|string',
                'company_email'         => 'required|string|email|max:255',
                'pic_name'              => 'required|string|max:255',
                'pic_phone_number'      => 'required|string|max:20',
                'pic_email'             => 'required|string|email|max:255',
                'company_npwp'          => 'nullable|string||max:255',
                'billing_address'       => 'nullable|string||max:255',
                'shipping_address'      => 'nullable|string||max:255',
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
            $data->updated_by = Auth::user()->name;
            $data->save();

            return response()->json(['success' => true, 'msg' => 'Customer successfully updated!']);
        } catch (\Throwable $th) {
            return response()->json(['failed' => true, 'msg' => 'Failed to update customer data!']);
        }
    }
}
