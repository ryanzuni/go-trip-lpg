<?php

namespace App\Http\Controllers;

use App\Models\DataMaster;
use Illuminate\Http\Request;
use App\Models\Transaksi;

class DataMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        // $dataMasters = Transaksi::with('paketWisata')->get();
        // return view('admin.data_masters.index', compact('dataMasters'));
        // $dataMasters = Transaksi::with('paketWisata')->paginate(10);
        // return view('admin.data_masters.index', compact('dataMasters'));
        $query = Transaksi::with('paketWisata');

        if($request->status && $request->status != 'all'){
            $query->where('status', $request->status);
        }

        if($request->start_date && $request->end_date){
            $query->whereBetween('tanggal_berangkat', [$request->start_date, $request->end_date]);
        }

        $dataMasters = $query->orderBy('created_at','desc')->paginate(10);

        return view('admin.data_masters.index', compact('dataMasters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(DataMaster $dataMaster)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DataMaster $dataMaster)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DataMaster $dataMaster)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DataMaster $dataMaster)
    {
        //
    }
}
