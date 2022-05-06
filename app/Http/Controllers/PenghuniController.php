<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Penghuni;
use Illuminate\Support\Facades\DB;
use App\Models\Kamar;
use App\Models\Tagihan;

class PenghuniController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $penghuni = DB::table('penghuni')
                    ->join('kamar', 'penghuni.id_kamar', '=', 'kamar.id')
                    ->select('penghuni.*', 'kamar.no_kamar')
                    ->where('penghuni.deleted_at', null)
                    ->get();

        $kamar = DB::table('kamar')
            ->select('id', 'no_kamar')
            ->where('status', 0)
            ->get();

        return view('penghuni', compact('penghuni', 'kamar'));
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


        $penghuni = Penghuni::create([
            'nama' => $request->nama,
            'no_hp' => $request->no_tlp,
            'asal' => $request->asal,
            'tgl_masuk' => $request->tgl_masuk,
            'lama_sewa' => $request->lama,
            'id_kamar' => $request->kamar,
        ]);
        $kamar   =   Kamar::find($request->kamar);
        $kamar->status = 1;
        $kamar->save();

        $date1 = date("Y-m-d", strtotime($request->tgl_masuk." +$request->lama months"));
        $kamarh = Kamar::select('harga')->where('id',$request->kamar)->get();
        $kamarhasil = ($kamarh[0]['harga']*$request->lama);
        $id_penghuni1 = $penghuni->id;
        $tagihan = Tagihan::create([
            'id_penghuni' => $id_penghuni1,
            'tagihan' => $kamarhasil,
            'deadline' => $date1,
            'tgl_bayar' => $date1,
            'status' => 0
        ]);

        return response()->json(['success' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        // $where = array('id' => $request->id);
        // $hasil  = Penghuni::where($where)->first();
        $penghuni = DB::table('penghuni')
                    ->select('penghuni.*','kamar.no_kamar')
                    ->leftJoin('kamar', 'kamar.id', '=', 'penghuni.id_kamar')
                    ->where('penghuni.id',$request->id)
                    ->get()
                    ->first();

        return response()->json($penghuni);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if (!empty($request->kamar_baru)) {
            $kamar   =   Kamar::find($request->kamar);
            $kamar->status = 0;
            $kamar->save();

            $kamarb   =   Kamar::find($request->kamar_baru);
            $kamarb->status = 1;
            $kamarb->save();
        }

        $penghuni   =   Penghuni::find($request->id);

        // dd($request->nama);
        $penghuni->nama = $request->nama;
        $penghuni->asal = $request->asal;
        $penghuni->no_hp = $request->no_tlp;
        if (!empty($request->kamar_baru)) {
            $penghuni->id_kamar = $request->kamar_baru;
        }
        $penghuni->lama_sewa = $request->lama;
        $penghuni->save();

        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $penghuni = Penghuni::find($request->id);

        $penghuni->delete();

        $kamar   =   Kamar::find($request->id_kamar);
        $kamar->status = 0;
        $kamar->save();
    }
}
