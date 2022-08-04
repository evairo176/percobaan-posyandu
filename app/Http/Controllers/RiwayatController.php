<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RiwayatController extends Controller
{
    public function index()
    {
        $riwayat = DB::table('tb_detail')
            ->leftJoin('districts', 'tb_detail.kecamatan_id', '=', 'districts.id')
            ->leftJoin('tb_rekap_posyandu', 'tb_detail.posyandu_id', '=', 'tb_rekap_posyandu.id')
            ->leftJoin('users', 'tb_detail.user_id', '=', 'users.id')
            ->select(
                'tb_detail.*',
                'users.*',
                'districts.*',
                'tb_rekap_posyandu.*',
                'tb_detail.id as id_del',
                'districts.name as kec',
                'users.name as nama_petugas',
            )
            ->where('tb_detail.kecamatan_id', auth()->user()->kecamatan_id)
            ->get();
        // dd($riwayat);
        $data = [
            'menu' => 'table',
            'submenu' => 'Riwayat perkembangan kecamatan',
            'riwayat' => $riwayat

        ];
        return view('pages.backend.kecamatan.riwayat', $data);
    }
}
