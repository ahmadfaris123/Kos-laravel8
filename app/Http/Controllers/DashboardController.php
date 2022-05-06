<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $kamar = DB::table('kamar')->count();
        $kamark = DB::table('kamar')
                    ->where('status', 0)
                    ->count();
        $penghuni = DB::table('penghuni')->count();
        $bayar0 = DB::table('tagihan')
                    ->where('status', 0)
                    ->count();
        return view('index', compact('kamar', 'penghuni', 'kamark', 'bayar0'));
    }
}
