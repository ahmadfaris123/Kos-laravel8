<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Tagihan;
use App\Models\Penghuni;
use App\Models\Kamar;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $tagihan = DB::table('tagihan')
                    ->join('penghuni', 'tagihan.id_penghuni', '=', 'penghuni.id')
                    ->select('tagihan.*', 'penghuni.nama', 'penghuni.tgl_masuk')
                    ->where('status',0)
                    ->where('penghuni.deleted_at', null)
                    ->get();
                    
        return view('tagihan', compact('tagihan'));
    }

    public function selesai()
    {
        $tagihan = DB::table('tagihan')
                    ->leftJoin('penghuni', 'penghuni.id', '=', 'tagihan.id_penghuni')
                    ->select('tagihan.*', 'penghuni.nama')
                    ->where('status',1)
                    ->get();

        return view('tagihanS', compact('tagihan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function lanjut(Request $request)
    {  
        $dataa =  Tagihan::find($request->id);
        $idp = Penghuni::select('lama_sewa')->where('id', $dataa ->id_penghuni)->get();
        $lama = $idp[0]['lama_sewa'];
        $date1 = date("Y-m-d", strtotime($request->tgl_bayar." +$lama months"));

        $tagihan = Tagihan::create([
            'id_penghuni' => $dataa ->id_penghuni,
            'tagihan' => $dataa ->tagihan,
            'deadline' => $date1,
            'tgl_bayar' => $date1,
            'status' => 0
        ]);

        $bayar   =   Tagihan::find($request->id);
        $bayar->status = 1;
        $bayar->tgl_bayar = $request->tgl_bayar;
        $bayar->save();

        return response()->json(['success' => true]);
    }
    public function update(Request $request)
    {
        $data1 = Tagihan::find($request->id);
        $kmr = Penghuni::select('id_kamar')->where('id', $data1 ->id_penghuni)->first();
        $kamar   =   Kamar::find($kmr->id_kamar);
        $kamar->status = 0;
        $kamar->save();

        $penghuni = Penghuni::find($data1->id_penghuni);
        $penghuni->delete();

        $bayar   =   Tagihan::find($request->id);
        $bayar->status = 1;
        $bayar->tgl_bayar = $request->tgl_bayar;
        $bayar->save();

        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
