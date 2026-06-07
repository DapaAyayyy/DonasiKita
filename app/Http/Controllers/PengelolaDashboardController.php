<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class PengelolaDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_kampanye' => DB::table('kampanye_sosial')->count(),
            'kampanye_aktif' => DB::table('kampanye_sosial')->where('status', 'aktif')->count(),
            'kampanye_selesai' => DB::table('kampanye_sosial')->where('status', 'selesai')->count(),
            'total_dana' => DB::table('donasi')->where('status_donasi', 'berhasil')->sum('nominal'),
            'total_donatur' => DB::table('donatur')->count(),
            'total_transaksi' => DB::table('donasi')->count(),
            'donasi_pending' => DB::table('donasi')->where('status_donasi', 'pending')->count(),
            'donasi_berhasil' => DB::table('donasi')->where('status_donasi', 'berhasil')->count(),
            'donasi_gagal' => DB::table('donasi')->whereIn('status_donasi', ['gagal', 'expired', 'cancelled'])->count(),
            'total_laporan' => DB::table('laporan')->count(),
        ];

        $donasiTerbaru = DB::table('donasi')
            ->leftJoin('donatur', 'donasi.id_donatur', '=', 'donatur.id_donatur')
            ->leftJoin('kampanye_sosial', 'donasi.id_kampanye', '=', 'kampanye_sosial.id_kampanye')
            ->select('donasi.*', 'donatur.nama as nama_donatur', 'kampanye_sosial.judul_kampanye')
            ->orderByDesc('donasi.tanggal_donasi')
            ->orderByDesc('donasi.id_donasi')
            ->limit(5)
            ->get();

        $kampanyeTerbaru = DB::table('kampanye_sosial')
            ->leftJoin('penerima', 'kampanye_sosial.id_penerima', '=', 'penerima.id_penerima')
            ->select('kampanye_sosial.*', 'penerima.nama as nama_penerima')
            ->orderByDesc('kampanye_sosial.tanggal_dibuat')
            ->orderByDesc('kampanye_sosial.id_kampanye')
            ->limit(5)
            ->get();

        return view('pengelola.dashboard', compact('stats', 'donasiTerbaru', 'kampanyeTerbaru'));
    }
}
