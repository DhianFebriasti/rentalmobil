<?php

namespace App\Http\Controllers;

use App\Pengeluaran;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.pengeluaran.index');
    }

    public function datatable(Request $request)
    {
        if($request->ajax()) {
            $data = Pengeluaran::all();
            return DataTables::of($data)->addIndexColumn()
                                        ->addColumn('pengeluaran', function($row) {
                                            return $row->pengeluaran;
                                        })
                                        ->addColumn('jumlah', function($row) {
                                            $jumlah = number_format($row->jumlah, 0, ',', '.');

                                            return $jumlah;
                                        })
                                        ->addColumn('tanggal', function($row) {
                                            $tanggal = date('d/m/Y', strtotime($row->tanggal));

                                            return $tanggal;
                                        })
                                        ->addColumn('menu', function($row) {
                                            return "";
                                        })
                                        ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipe = "tambah";
        $data['tipe'] = $tipe;
        return view('backend.pengeluaran.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pengeluaran    = $request->pengeluaran;
        $jumlah         = str_replace('.', '', $request->jumlah);
        $tanggal        = $request->tanggal;

        $data['pengeluaran']    = $pengeluaran;
        $data['jumlah']         = $jumlah;
        $data['tanggal']        = $tanggal;

        Pengeluaran::create($data);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pengeluaran  $pengeluaran
     * @return \Illuminate\Http\Response
     */
    public function show(Pengeluaran $pengeluaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pengeluaran  $pengeluaran
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengeluaran $pengeluaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pengeluaran  $pengeluaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pengeluaran $pengeluaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pengeluaran  $pengeluaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengeluaran $pengeluaran)
    {
        //
    }
}
