<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use App\Models\Perkembangan;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class KecamatanPerkembangan extends Controller
{
    //

    public function index()
    {
        $perkembangan = DB::table('tb_perkembangan')
            ->leftJoin('districts', 'tb_perkembangan.kecamatan_id', '=', 'districts.id')
            ->leftJoin('villages', 'tb_perkembangan.kelurahan_id', '=', 'villages.id')
            ->leftJoin('users', 'tb_perkembangan.user_id', '=', 'users.id')
            ->leftJoin('tb_rekap_posyandu', 'tb_perkembangan.posyandu_id', '=', 'tb_rekap_posyandu.id')
            ->select(
                'tb_perkembangan.*',
                'districts.*',
                'villages.*',
                'tb_perkembangan.id as id_per',
                'districts.name as kec',
                'villages.name as kel',
                'users.name as name_petugas',
                'tb_rekap_posyandu.nama_posyandu as nama_posyandu',
            )
            ->orderBy('tb_perkembangan.id', 'DESC')
            ->where('tb_perkembangan.kecamatan_id', auth()->user()->kecamatan_id)
            ->get();
        $data = [
            'menu' => 'table',
            'submenu' => 'Input All Rekap Perkembangan',
            'perkembangan' => $perkembangan

        ];
        // dd($data);
        return view('pages.backend.rekap-kecamatan-perkembangan', $data);
    }

    public function detailPer($id)
    {
        // dd('ad');
        $perkembangan = DB::table('tb_perkembangan')
            ->leftJoin('districts', 'tb_perkembangan.kecamatan_id', '=', 'districts.id')
            ->leftJoin('villages', 'tb_perkembangan.kelurahan_id', '=', 'villages.id')
            ->leftJoin('users', 'tb_perkembangan.user_id', '=', 'users.id')
            ->leftJoin('tb_rekap_posyandu', 'tb_perkembangan.posyandu_id', '=', 'tb_rekap_posyandu.id')
            ->select(
                'tb_perkembangan.*',
                'districts.*',
                'villages.*',
                'tb_perkembangan.id as id_per',
                'districts.name as kec',
                'villages.name as kel',
                'users.name as name_petugas',
                'tb_rekap_posyandu.nama_posyandu as nama_posyandu',
            )
            ->orderBy('tb_perkembangan.id', 'DESC')
            ->where('tb_perkembangan.id', $id)
            ->first();

        // dd($perkembangan);
        $kaderTotal = DB::table('tb_kader')->where('posyandu_id', auth()->user()->posyandu_id)->count();
        $kaderTerlatih = DB::table('tb_kader')->where('posyandu_id', auth()->user()->posyandu_id)->where('terlatih', '!=', 'ya')->count();
        $data = [
            'menu' => 'table',
            'submenu' => 'Input All Rekap Perkembangan',
            'perkembangan' => $perkembangan,
            'kaderTotal' => $kaderTotal,
            'kaderTerlatih' => $kaderTerlatih,

        ];
        // dd($data);
        return view('pages.backend.kecamatan.detail', $data);
    }
    public function updateStatusDitolak($id)
    {
        $perkembangan = Perkembangan::find($id);
        $perkembangan->status = 'kecamatan ditolak';
        $perkembangan->update();

        $data = [
            'nama_admin' =>  auth()->user()->name,
            'user_id' => $perkembangan->user_id,
            'perkembangan_id' => $perkembangan->id,
            'posyandu_id' => $perkembangan->posyandu_id,
            'kecamatan_id' => auth()->user()->kecamatan_id,
            'status' => $perkembangan->status,
        ];
        $detail = Detail::create($data);
        return redirect('kecamatan-perkembangan');
    }
    public function updateStatusDiterima($id)
    {
        $perkembangan = Perkembangan::find($id);
        $perkembangan->status = 'kecamatan diterima';
        $perkembangan->update();

        $data = [
            'nama_admin' =>  auth()->user()->name,
            'user_id' => $perkembangan->user_id,
            'perkembangan_id' => $perkembangan->id,
            'posyandu_id' => $perkembangan->posyandu_id,
            'kecamatan_id' => auth()->user()->kecamatan_id,
            'status' => $perkembangan->status,
        ];
        $detail = Detail::create($data);
        return redirect('kecamatan-perkembangan');
    }
}
