<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DesainProduct;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
// use Intervention\Image\Facades\Image;
use Intervention\Image\Facades\Image as Image;

class DesainProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:list-desain-product', ['only' => ['index']]);
        $this->middleware('permission:create-desain-product', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-desain-product', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-desain-product', ['only' => ['delete']]);
    }

    public function index()
    {
        $data['page_title'] = 'Desain Product';
        return view('design.design-product.index', $data);
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = DesainProduct::orderBy('created_at','desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $editUrl = route('desain-product-edit', $row->id);
                    $deleteUrl = route('desain-product-delete', $row->id);
                    $dropdown = "<div class='dropdown'>
                                    <button class='btn btn-light btn-sm dropdown-toggle' type='button' data-bs-toggle='dropdown' aria-expanded='true'>
                                        <i class='uil uil-ellipsis-h'></i>
                                    </button>
                                    <ul class='dropdown-menu dropdown-menu-end'>
                                        <li><a class='dropdown-item edit' href='$editUrl'>Edit</a></li>
                                        <li><a class='dropdown-item delete' href='javascript:void(0);' data-url='$deleteUrl'>Delete</a></li>
                                    </ul>
                                </div>";
                    return $dropdown;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['page_title'] = 'Tambah Desain Product';
        $data['desain_products'] = DesainProduct::orderBy('nama_desain','asc')->get();

        return view('design.design-product.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama_desain'       => 'required|string|max:225',
                'deskripsi'         => 'nullable',
                'file_desain'       => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
                'tanggal_buat'      => 'required',
            ]);
    
            $desain_product = new DesainProduct();
            $desain_product->nama_desain = $request->input('nama_desain');
            $desain_product->deskripsi = $request->input('deskripsi');
            $desain_product->tanggal_buat = $request->input('tanggal_buat');
            $desain_product->created_by = auth()->user()->name;

            if ($request->hasFile('file_desain')) {
                $image = $request->file('file_desain');
                $imageName = uniqid() . '' . time() . '.webp';

                // Resize and compres image
                $resizedImage = Image::make($image)
                    ->resize(90, 90, function ($constraint) {
                        $constraint->aspectRatio();
                    })
                    ->encode('webp', 80); // Kompresi kualitas 80%

                // Save iamge after resize, compres, and change format to webp format
                $resizedImage->save(public_path('assest/images/desain-product/' . $imageName));
                $desain_product->file_desain = $imageName;
            }

            $desain_product->save();
    
            return response()->json(['success' => true, 'msg' => 'Data Desain Product berhasil disimpan!']);
        } catch (\Throwable $th) {
            return response()->json(['failed' => true, 'msg' => $th->getMessage()]);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(DesainProduct $desainProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['page_title'] = 'Edit Desian Product';
        $data['desain_product'] = DesainProduct::find($id);

        return view('design.design-product.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'nama_desain'       => 'required|string|max:225',
                'deskripsi'         => 'nullable',
                'file_desain'       => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
                'tanggal_buat'      => 'required',
            ]);
    
            $desain_product = DesainProduct::find($id);
            $desain_product->nama_desain = $request->input('nama_desain');
            $desain_product->deskripsi = $request->input('deskripsi');
            $desain_product->tanggal_buat = $request->input('tanggal_buat');
            $desain_product->updated_by = auth()->user()->name;

            if ($request->hasFile('file_desain')) {
                $image = $request->file('file_desain');
                $imageName = uniqid() . '' . time() . '.webp';

                // Resize and compres image
                $resizedImage = Image::make($image)
                    ->resize(90, 90, function ($constraint) {
                        $constraint->aspectRatio();
                    })
                    ->encode('webp', 80); // Kompresi kualitas 80%

                // Save iamge after resize, compres, and change format to webp format
                $resizedImage->save(public_path('assets/images/desain-product/' . $imageName));
                $desain_product->file_desain = $imageName;
            }

            $desain_product->save();
    
            return response()->json(['success' => true, 'msg' => 'Data Sesain Product berhasil diedit!']);
        } catch (\Throwable $th) {
            return response()->json(['failed' => true, 'msg' => $th->getMessage()]);
        }
    }

    public function delete($id)
    {
        $desain_product = DesainProduct::find($id);
        if ($desain_product) {
            $desain_product->delete();
            return response()->json(['success' => 'Data Desain Product berhasil dihapus!']);
        }
        return response()->json(['error' => 'Data Desain Product tidak ditemukan']);
    }
}
