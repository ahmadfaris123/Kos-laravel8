<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Kamar;

class KamarController extends Controller
{
    public function index()
    {
        $kamar = Kamar::all();
        return view('kamar', compact('kamar'));
    }

    public function store(Request $request)
    {

        $kamar = new kamar;

        $kamar = kamar::create([
            'no_kamar' => $request->no_kamar,
            'fasilitas' => $request->fasilitas,
            'harga' => $request->harga,
            'status' => 0,
        ]);

        // for ($no = 1; $no <= $request->jumlah; $no++) {
        //     $kamar = kamar::create([
        //         'no_kamar' => 0,
        //     ]);
        // }



        return response()->json(['success' => true]);
    }

    public function show(Request $request)
    {
        $where = array('id' => $request->id);
        $hasil  = Kamar::where($where)->first();

        return response()->json($hasil);
    }

    public function update(Request $request)
    {
        $kamar   =   Kamar::find($request->id);

        $kamar->no_kamar = $request->no_kamar;
        $kamar->fasilitas = $request->fasilitas;
        $kamar->harga = $request->harga;
        $kamar->save();


        return response()->json(['success' => true]);
    }

    public function destroy(Request $request)
    {
        $kamar = Kamar::find($request->id);

        $kamar->delete();
    }
}
