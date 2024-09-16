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

    public function hrWorkScheduleIndex()
    {
        $data['page_title'] = 'Work Schedule';
        return view('human-resource.work-schedule.index', $data);
    }

    public function create()
    {
        $data['page_title'] = 'Tambah Work Schedule';

        return view('human-resource.work-schedule.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name'          => 'required|string|max:225',
                'start_time'    => 'required',
                'end_time'      => 'required',
                'description'   => 'nullable',
            ]);
    
            $shift = new Shift();
            $shift->name = $request->input('name');
            $shift->start_time = $request->input('start_time');
            $shift->end_time = $request->input('end_time');
            $shift->description = $request->input('description');
            $shift->save();
    
            return response()->json(['success' => true, 'msg' => 'Data Shift berhasil disimpan!']);
        } catch (\Throwable $th) {
            return response()->json(['failed' => true, 'msg' => 'Gagal Simpan Data!']);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Shift $shift)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['page_title'] = 'Edit Shift';
        $data['shift'] = Shift::find($id);

        return view('master-data.shift.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name'          => 'required|string|max:225',
                'start_time'    => 'required',
                'end_time'      => 'required',
                'description'   => 'nullable',
            ]);
    
            $shift = Shift::find($id);
            $shift->name = $request->input('name');
            $shift->start_time = $request->input('start_time');
            $shift->end_time = $request->input('end_time');
            $shift->description = $request->input('description');
            $shift->save();
    
            return response()->json(['success' => true, 'msg' => 'Data Quotation berhasil diedit!']);
        } catch (\Throwable $th) {
            return response()->json(['failed' => true, 'msg' => $th->getMessage()]);
            // return response()->json(['failed' => true, 'msg' => 'Gagal Simpan Data!']);
        }
    }

    public function delete($id)
    {
        $shift = Shift::find($id);
        if ($shift) {
            $shift->delete();
            return response()->json(['success' => 'Data Shift berhasil dihapus!']);
        }
        return response()->json(['error' => 'Data Shift tidak ditemukan']);
    }
}
