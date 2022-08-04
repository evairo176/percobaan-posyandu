<?php

namespace App\Http\Controllers;

use App\Models\Perkembangan;
use App\Models\Strata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DataTables;
use Illuminate\Support\Facades\DB;

class PerkembanganController extends Controller
{
    public function index()
    {
        if (auth()->user()->posyandu_id) {
            if (Perkembangan::all()) {
                $perkembangan =  DB::table('tb_perkembangan')->where('posyandu_id', auth()->user()->posyandu_id)->get();
                $posyandu = DB::table('tb_rekap_posyandu')->where('id', auth()->user()->posyandu_id)->first();
                // $strata = DB::table('tb_strata')->where('posyandu_id', auth()->user()->posyandu_id)->first();
                $kaderTotal = DB::table('tb_kader')->where('posyandu_id', auth()->user()->posyandu_id)->count();
                $kaderTerlatih = DB::table('tb_kader')->where('posyandu_id', auth()->user()->posyandu_id)->where('terlatih', '!=', 'ya')->count();
                // $skdn = DB::table('tb_skdn')->where('posyandu_id', auth()->user()->posyandu_id)->first();
                // $kegiatan = DB::table('tb_kegiatan_utama')->where('posyandu_id', auth()->user()->posyandu_id)->first();
                // $program = DB::table('tb_program')->where('posyandu_id', auth()->user()->posyandu_id)->first();
                // dd($perkembangan->tahun_rekap);
                // dd($kaderTotal);
                $data = [
                    'menu' => 'table',
                    'submenu' => 'Input Rekap Perkembangan',
                    'perkembangan' => $perkembangan,
                    'pos' => $posyandu,
                    // 'strata' => $strata,
                    'kaderTotal' => $kaderTotal,
                    'kaderTerlatih' => $kaderTerlatih,
                    // 'skdn' => $skdn,
                    // 'kegiatan' => $kegiatan,
                    // 'program' => $program,
                ];
                // dd($data);
                return view('pages.backend.rekap-perkembangan', $data);
            }
        } else {
            return redirect()->back();
        }
    }
    public function fetchAll(Request $request)
    {
        if (auth()->user()->posyandu_id) {
            if ($request->ajax()) {
                $data = DB::table('tb_perkembangan')
                    ->where('posyandu_id', auth()->user()->posyandu_id)
                    ->leftJoin('districts', 'tb_perkembangan.kecamatan_id', '=', 'districts.id')
                    ->leftJoin('villages', 'tb_perkembangan.kelurahan_id', '=', 'villages.id')
                    ->select(
                        'tb_perkembangan.*',
                        'districts.*',
                        'villages.*',
                        'tb_perkembangan.id as id_per',
                        'districts.name as kec',
                        'villages.name as kel',
                    )
                    ->orderBy('tb_perkembangan.id', 'DESC')
                    ->get();
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('created_at', function ($row) {
                        $date = date('d-m-Y', strtotime($row->created_at));
                        return $date;
                    })
                    ->addColumn('action', function ($row) {
                        $actionBtn = '       <td class="text-center">
                    <ul class="table-controls">
                    <li><a href="javascript:void(0);" id="' . $row->id_per . '" class="editIcon" data-bs-toggle="modal" data-bs-target="#editdataloyeeModal" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 text-success"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a></li>                                       
                     </ul>';
                        return $actionBtn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
        } else {
            return response()->json([
                'status' => 201,
                'messages' => 'Data Tidak ada'
            ]);
        }
    }
    public function store(Request $request)
    {
        // dd($request->cek);
        $pra = 0;
        $mad = 0;
        $pur = 0;
        $man = 0;
        switch (@$request->cek) {
            case 'pra':
                $pra = 1;
                break;
            case 'mad':
                $mad = 1;
                break;
            case 'pur':
                $pur = 1;
                break;
            case 'man':
                $man = 1;
                break;
        }

        if ($request->paud != 1) {
            $request->paud = 0;
        }
        if ($request->bkb != 1) {
            $request->bkb = 0;
        }
        if ($request->bkr != 1) {
            $request->bkr = 0;
        }
        if ($request->bkl != 1) {
            $request->bkl = 0;
        }
        if ($request->up2k != 1) {
            $request->up2k = 0;
        }
        if ($request->in != 1) {
            $request->in = 0;
        }
        // dd($request->paud);
        // $paud = 0;
        // $bkb = 0;
        // $bkr = 0;
        // $bkl = 0;
        // $up2k = 0;
        // $as = 0;
        // $in = 0;
        // if ($request->paud != 0) {
        // }
        // dd($request->all());
        if ($request->perkembangan_id) {
            $validator  = Validator::make(request()->all(), [
                'tahun_rekap' => 'required|numeric',
                'jml_bgn' => 'required|numeric',
                'jml_kader' => 'required|numeric',
                'jml_terlatih' => 'required|numeric',
                's' => 'required|numeric',
                'k' => 'required|numeric',
                'd' => 'required|numeric',
                'n' => 'required|numeric',
                'vit_a' => 'required|numeric',
                'kb_aktif' => 'required|numeric',
                'k4' => 'required|numeric',
                'fe3' => 'required|numeric',
                'campak' => 'required|numeric',
                'bcg' => 'required|numeric',
                'dpt' => 'required|numeric',
                'hbo' => 'required|numeric',
                'polio' => 'required|numeric',
                'gizi' => 'required|numeric',
                'diare' => 'required|numeric',
                // 'paud' => 'required|numeric',
                // 'bkb' => 'required|numeric',
                // 'bkr' => 'required|numeric',
                // 'bkl' => 'required|numeric',
                // 'up2k' => 'required|numeric',
                'as' => 'required|numeric',
                // 'in' => 'required|numeric',
                'ds' => 'required|numeric',
            ]);

            if ($validator->fails()) {
                // dd($validator->getMessageBag());
                return response()->json([
                    'status' => 400,
                    'messages' => $validator->getMessageBag()
                ]);
            } else {
                $perkembangan = Perkembangan::find($request->perkembangan_id);
                $perkembanganData = [
                    'posyandu_id' => auth()->user()->posyandu_id,
                    'user_id' => auth()->user()->id,
                    'kelurahan_id' => $request->kelurahan_id,
                    'kecamatan_id' => $request->kecamatan_id,
                    'tahun_rekap' => $request->tahun_rekap,
                    'pra' => $pra,
                    'mad' => $mad,
                    'pur' => $pur,
                    'man' => $man,
                    'jml_bgn' => $request->jml_bgn,
                    'jml_kader' => $request->jml_kader,
                    'jml_terlatih' => $request->jml_terlatih,
                    's' => $request->s,
                    'k' => $request->k,
                    'd' => $request->d,
                    'n' => $request->n,
                    'vit_a' => $request->vit_a,
                    'kb_aktif' => $request->kb_aktif,
                    'k4' => $request->k4,
                    'fe3' => $request->fe3,
                    'campak' => $request->campak,
                    'bcg' => $request->bcg,
                    'dpt' => $request->dpt,
                    'hbo' => $request->hbo,
                    'polio' => $request->polio,
                    'gizi' => $request->gizi,
                    'diare' => $request->diare,
                    'paud' => $request->paud,
                    'bkb' => $request->bkb,
                    'bkr' => $request->bkr,
                    'bkl' => $request->bkl,
                    'up2k' => $request->up2k,
                    'as' => $request->as,
                    'in' => $request->in,
                    'ds' => $request->ds,
                ];
                // dd($perkembanganData);
                $perkembangan->update($perkembanganData);
                return response()->json([
                    'status' => 200,
                    'messages' => 'Updated Successfully'
                ]);
            }
        } else {
            $validator  = Validator::make(request()->all(), [
                'tahun_rekap' => 'required',
                'jml_bgn' => 'required|numeric',
                'jml_kader' => 'required|numeric',
                'jml_terlatih' => 'required|numeric',
                's' => 'required|numeric',
                'k' => 'required|numeric',
                'd' => 'required|numeric',
                'n' => 'required|numeric',
                'vit_a' => 'required|numeric',
                'kb_aktif' => 'required|numeric',
                'k4' => 'required|numeric',
                'fe3' => 'required|numeric',
                'campak' => 'required|numeric',
                'bcg' => 'required|numeric',
                'dpt' => 'required|numeric',
                'hbo' => 'required|numeric',
                'polio' => 'required|numeric',
                'gizi' => 'required|numeric',
                'diare' => 'required|numeric',
                // 'paud' => 'required|numeric',
                // 'bkb' => 'required|numeric',
                // 'bkr' => 'required|numeric',
                // 'bkl' => 'required|numeric',
                // 'up2k' => 'required|numeric',
                'as' => 'required|numeric',
                // 'in' => 'required|numeric',
                'ds' => 'required|numeric',
            ]);

            if ($validator->fails()) {
                // dd($validator->getMessageBag());
                return response()->json([
                    'status' => 400,
                    'messages' => $validator->getMessageBag()
                ]);
            } else {

                $perkembanganData = [
                    'posyandu_id' => auth()->user()->posyandu_id,
                    'user_id' => auth()->user()->id,
                    'kelurahan_id' => $request->kelurahan_id,
                    'kecamatan_id' => $request->kecamatan_id,
                    'tahun_rekap' => $request->tahun_rekap,
                    'pra' => $pra,
                    'mad' => $mad,
                    'pur' => $pur,
                    'man' => $man,
                    'jml_bgn' => $request->jml_bgn,
                    'jml_kader' => $request->jml_kader,
                    'jml_terlatih' => $request->jml_terlatih,
                    's' => $request->s,
                    'k' => $request->k,
                    'd' => $request->d,
                    'n' => $request->n,
                    'vit_a' => $request->vit_a,
                    'kb_aktif' => $request->kb_aktif,
                    'k4' => $request->k4,
                    'fe3' => $request->fe3,
                    'campak' => $request->campak,
                    'bcg' => $request->bcg,
                    'dpt' => $request->dpt,
                    'hbo' => $request->hbo,
                    'polio' => $request->polio,
                    'gizi' => $request->gizi,
                    'diare' => $request->diare,
                    'paud' => $request->paud,
                    'bkb' => $request->bkb,
                    'bkr' => $request->bkr,
                    'bkl' => $request->bkl,
                    'up2k' => $request->up2k,
                    'as' => $request->as,
                    'in' => $request->in,
                    'ds' => $request->ds,
                ];

                Perkembangan::create($perkembanganData);
                return response()->json([
                    'status' => 200,
                    'messages' => 'Updated Successfully'
                ]);
            }
        }
    }
    public function edit(Request $request)
    {
        $id = $request->id;
        // dd($id);
        $user = Perkembangan::find($id);
        // dd($data->password);
        return response()->json($user);
    }
    public function detailperkembangan(Request $request)
    {
        $data = [
            'menu' => 'table',
            'submenu' => 'Input Detail Perkembangan'
        ];
        return view('pages.backend.detail-rekap-perkembangan', $data);
    }
    public function datadetailperkembangan(Request $request)
    {
        $data_perkembangan  = DB::table('districts')->where('regency_id', 3212)->get();
        $Getyears           = $request->input('tahun');
        $o                  = 0;
        $ttl_kel            = 0;
        $ttl_dt_per_kel     = 0;
        $ttl_posyandu       = 0;
        $ttl_tahun_rekap    = 0;
        $ttl_pra            = 0;
        $ttl_mad            = 0;
        $ttl_pur            = 0;
        $ttl_man            = 0;
        $ttl_man_per        = 0;
        $ttl_jml_bgn        = 0;
        $ttl_jml_bgn_per    = 0;
        $ttl_jml_kader      = 0;
        $ttl_jml_terlatih   = 0;
        $ttl_jml_terlatih_per = 0;
        $ttl_s              = 0;
        $ttl_k              = 0;
        $ttl_d              = 0;
        $ttl_n              = 0;
        $ttl_d_s_pr         = 0;
        $ttl_n_d_pr         = 0;
        $ttl_vit_a          = 0;
        $ttl_kb_aktif       = 0;
        $ttl_k4             = 0;
        $ttl_fe3            = 0;
        $ttl_campak         = 0;
        $ttl_bcg            = 0;
        $ttl_dpt            = 0;
        $ttl_hbo            = 0;
        $ttl_polio          = 0;
        $ttl_gizi           = 0;
        $ttl_diare          = 0;
        $ttl_paud           = 0;
        $ttl_bkb            = 0;
        $ttl_bkr            = 0;
        $ttl_bkl            = 0;
        $ttl_up2k           = 0;
        $ttl_as             = 0;
        $ttl_in             = 0;
        $ttl_ds             = 0;
        $ttl_man_per        = 0;
        foreach ($data_perkembangan as $per) {

            $dt         = DB::table('tb_perkembangan')->where('status', 'dpmd diterima');
            $dt_ps      = DB::table('tb_rekap_posyandu');
            $dt_dsa     = DB::table('villages')->where('district_id', @$per->id)->count();

            $dt->where('kecamatan_id', $per->id);
            $dt_ps->where('kecamatan_id', $per->id);
            if ($Getyears) {
                $dt->whereYear('tahun_rekap', $Getyears);
                $dt_ps->whereYear('created_at', $Getyears);
            }
            $dt_per_kel     = $dt->get();
            $posyandu       = $dt_ps->count();
            $tahun_rekap    = 0;
            $pra            = 0;
            $mad            = 0;
            $pur            = 0;
            $man            = 0;
            $man_per        = 0;
            $jml_bgn        = 0;
            $jml_kader      = 0;
            $jml_terlatih   = 0;
            $s              = 0;
            $k              = 0;
            $d              = 0;
            $n              = 0;
            $vit_a          = 0;
            $kb_aktif       = 0;
            $k4             = 0;
            $fe3            = 0;
            $campak         = 0;
            $bcg            = 0;
            $dpt            = 0;
            $hbo            = 0;
            $polio          = 0;
            $gizi           = 0;
            $diare          = 0;
            $paud           = 0;
            $bkb            = 0;
            $bkr            = 0;
            $bkl            = 0;
            $up2k           = 0;
            $as             = 0;
            $in             = 0;
            $ds             = 0;
            foreach ($dt_per_kel as $klue) {
                $pra            += @$klue->pra;
                $mad            += @$klue->mad;
                $pur            += @$klue->pur;
                $man            += @$klue->man;
                $jml_bgn        += @$klue->jml_bgn;
                $jml_kader      += @$klue->jml_kader;
                $jml_terlatih   += @$klue->jml_terlatih;
                $s              += @$klue->s;
                $k              += @$klue->k;
                $d              += @$klue->d;
                $n              += @$klue->n;
                $vit_a          += @$klue->vit_a;
                $kb_aktif       += @$klue->kb_aktif;
                $k4             += @$klue->k4;
                $fe3            += @$klue->fe3;
                $campak         += @$klue->campak;
                $bcg            += @$klue->bcg;
                $dpt            += @$klue->dpt;
                $hbo            += @$klue->hbo;
                $polio          += @$klue->polio;
                $gizi           += @$klue->gizi;
                $diare          += @$klue->diare;
                $paud           += @$klue->paud;
                $bkb            += @$klue->bkb;
                $bkr            += @$klue->bkr;
                $bkl            += @$klue->bkl;
                $up2k           += @$klue->up2k;
                $as             += @$klue->as;
                $in             += @$klue->in;
                $ds             += @$klue->ds;
            }
            @$data_perkembangan[$o]->jml_desa           = $dt_dsa;
            @$data_perkembangan[$o]->jml_pos            = $posyandu;
            @$data_perkembangan[$o]->pra                = $pra;
            @$data_perkembangan[$o]->mad                = $mad;
            @$data_perkembangan[$o]->pur                = $pur;
            @$data_perkembangan[$o]->man                = $man;
            @$data_perkembangan[$o]->man_per            = $man != 0 ? ceil((count($posyandu) / $man) * 100) : 0;
            @$data_perkembangan[$o]->jml_bgn            = $jml_bgn;
            @$data_perkembangan[$o]->jml_bgn_per        = $jml_bgn != 0 ? ceil((count($posyandu) / $jml_bgn) * 100) : 0;
            @$data_perkembangan[$o]->jml_kader          = $jml_kader;
            @$data_perkembangan[$o]->jml_terlatih       = $jml_terlatih;
            @$data_perkembangan[$o]->jml_terlatih_per   = $jml_terlatih != 0 ? ceil(($jml_terlatih / $jml_kader) * 100) : 0;
            @$data_perkembangan[$o]->s                  = $s;
            @$data_perkembangan[$o]->k                  = $k;
            @$data_perkembangan[$o]->d                  = $d;
            @$data_perkembangan[$o]->n                  = $n;
            @$data_perkembangan[$o]->d_s                = $d != 0 ? ceil(($d / $s) * 100) : 0;
            @$data_perkembangan[$o]->n_d                = $n != 0 ? ceil(($n / $n) * 100) : 0;
            @$data_perkembangan[$o]->vit_a              = $vit_a;
            @$data_perkembangan[$o]->kb_aktif           = $kb_aktif;
            @$data_perkembangan[$o]->k4                 = $k4;
            @$data_perkembangan[$o]->fe3                = $fe3;
            @$data_perkembangan[$o]->campak             = $campak;
            @$data_perkembangan[$o]->bcg                = $bcg;
            @$data_perkembangan[$o]->dpt                = $dpt;
            @$data_perkembangan[$o]->hbo                = $hbo;
            @$data_perkembangan[$o]->polio              = $polio;
            @$data_perkembangan[$o]->gizi               = $gizi;
            @$data_perkembangan[$o]->diare              = $diare;
            @$data_perkembangan[$o]->paud               = $paud;
            @$data_perkembangan[$o]->bkb                = $bkb;
            @$data_perkembangan[$o]->bkr                = $bkr;
            @$data_perkembangan[$o]->bkl                = $bkl;
            @$data_perkembangan[$o]->up2k               = $up2k;
            @$data_perkembangan[$o]->as                 = $as;
            @$data_perkembangan[$o]->in                 = $in;
            @$data_perkembangan[$o]->ds                 = $ds;

            $ttl_kel            += $dt_dsa;
            $ttl_posyandu       += $posyandu;
            $ttl_tahun_rekap    += $tahun_rekap;
            $ttl_pra            += $pra;
            $ttl_mad            += $mad;
            $ttl_pur            += $pur;
            $ttl_man            += $man;
            $ttl_man_per        += $man_per;
            $ttl_jml_bgn        += $jml_bgn;
            $ttl_jml_kader      += $jml_kader;
            $ttl_jml_terlatih   += $jml_terlatih;
            $ttl_s              += $s;
            $ttl_k              += $k;
            $ttl_d              += $d;
            $ttl_n              += $n;
            $ttl_vit_a          += $vit_a;
            $ttl_kb_aktif       += $kb_aktif;
            $ttl_k4             += $k4;
            $ttl_fe3            += $fe3;
            $ttl_campak         += $campak;
            $ttl_bcg            += $bcg;
            $ttl_dpt            += $dpt;
            $ttl_hbo            += $hbo;
            $ttl_polio          += $polio;
            $ttl_gizi           += $gizi;
            $ttl_diare          += $diare;
            $ttl_paud           += $paud;
            $ttl_bkb            += $bkb;
            $ttl_bkr            += $bkr;
            $ttl_bkl            += $bkl;
            $ttl_up2k           += $up2k;
            $ttl_as             += $as;
            $ttl_in             += $in;
            $ttl_ds             += $ds;
            $ttl_man_per        += @$data_perkembangan[$o]->man_per;
            $ttl_jml_bgn_per    += @$data_perkembangan[$o]->jml_bgn_per;
            $ttl_jml_terlatih_per += @$data_perkembangan[$o]->jml_terlatih_per;
            $ttl_d_s_pr         += @$data_perkembangan[$o]->d_s;
            $ttl_n_d_pr         += @$data_perkembangan[$o]->n_d;
            $o++;
        }

        $ttl = array(
            'ttl_dt_per_kel' => $ttl_kel,
            'ttl_posyandu' => $ttl_posyandu,
            'ttl_tahun_rekap' => $ttl_tahun_rekap,
            'ttl_pra' => $ttl_pra,
            'ttl_mad' => $ttl_mad,
            'ttl_pur' => $ttl_pur,
            'ttl_man' => $ttl_man,
            'ttl_man_per' => $ttl_man_per != 0 ? ceil(($o / $ttl_man_per) * 100) : 0,
            'ttl_jml_bgn' => $ttl_jml_bgn,
            'ttl_jml_bgn_per' => $ttl_jml_bgn_per != 0 ? ceil(($o / $ttl_jml_bgn_per) * 100) : 0,
            'ttl_jml_kader' => $ttl_jml_kader,

            'ttl_jml_terlatih' => $ttl_jml_terlatih,
            'jml_terlatih_per' => $ttl_jml_terlatih_per != 0 ? ceil(($o / $ttl_jml_terlatih_per) * 100) : 0,
            'ttl_s' => $ttl_s,
            'ttl_k' => $ttl_k,
            'ttl_d' => $ttl_d,
            'ttl_n' => $ttl_n,
            'ttl_d_s_pr' => $ttl_d_s_pr != 0 ? ceil(($o / $ttl_d_s_pr) * 100) : 0,
            'ttl_n_d_pr' => $ttl_n_d_pr != 0 ? ceil(($o / $ttl_n_d_pr) * 100) : 0,
            'ttl_vit_a' => $ttl_vit_a,
            'ttl_kb_aktif' => $ttl_kb_aktif,
            'ttl_k4' => $ttl_k4,
            'ttl_fe3' => $ttl_fe3,
            'ttl_campak' => $ttl_campak,
            'ttl_bcg' => $ttl_bcg,
            'ttl_dpt' => $ttl_dpt,
            'ttl_hbo' => $ttl_hbo,
            'ttl_polio' => $ttl_polio,
            'ttl_gizi' => $ttl_gizi,
            'ttl_diare' => $ttl_diare,
            'ttl_paud' => $ttl_paud,
            'ttl_bkb' => $ttl_bkb,
            'ttl_bkr' => $ttl_bkr,
            'ttl_bkl' => $ttl_bkl,
            'ttl_up2k' => $ttl_up2k,
            'ttl_as' => $ttl_as,
            'ttl_in' => $ttl_in,
            'ttl_ds' => $ttl_ds != 0 ? ceil(($ttl_ds / $o) * 100) : 0
        );
        if ($request->input('lo') == 'ex') {
            return view('pages.backend.data_excel_posyandu', compact('data_perkembangan', 'ttl'));
        } else {

            return response()->json(array('data_perkembangan' => $data_perkembangan, 'ttl' => $ttl));
        }
    }
}
