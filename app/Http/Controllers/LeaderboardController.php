<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LeaderboardController extends Controller
{
    public function index()
    {
        $leaderboard = DB::table('donasi')
            ->join('donatur', 'donasi.id_donatur', '=', 'donatur.id_donatur')
            ->select('donatur.nama', DB::raw('SUM(donasi.nominal) as total_donasi'))
            ->where('donasi.status_donasi', 'berhasil')
            ->groupBy('donasi.id_donatur', 'donatur.nama')
            ->orderByDesc('total_donasi')
            ->take(10)
            ->get();

        return view('leaderboard.index', compact('leaderboard'));
    }
}