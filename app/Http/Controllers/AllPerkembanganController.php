<?php

namespace App\Http\Controllers;

use App\Models\Perkembangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Support\Facades\Validator;

class AllPerkembanganController extends Controller
{
    public function index()
    {
        // $perkembangan =  DB::table('tb_perkembangan')->where('posyandu_id', auth()->user()->posyandu_id)->get();
        // $posyandu = DB::table('tb_rekap_posyandu')->where('id', auth()->user()->posyandu_id)->first();
        // // $strata = DB::table('tb_strata')->where('posyandu_id', auth()->user()->posyandu_id)->first();
        // $kaderTotal = DB::table('tb_kader')->where('posyandu_id', auth()->user()->posyandu_id)->count();
        // $kaderTerlatih = DB::table('tb_kader')->where('posyandu_id', auth()->user()->posyandu_id)->where('terlatih', '!=', 'ya')->count();

        $data = [
            'menu' => 'table',
            'submenu' => 'Input All Rekap Perkembangan',
            // 'perkembangan' => $perkembangan,
            // 'pos' => $posyandu,
            // 'kaderTotal' => $kaderTotal,
            // 'kaderTerlatih' => $kaderTerlatih,
        ];
        // dd($data);
        return view('pages.backend.rekap-all-perkembangan', $data);
    }
    public function fetchAll(Request $request)
    {

        if ($request->ajax()) {
            $data = DB::table('tb_perkembangan')
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
                ->get();
            // dd($data);
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('created_at', function ($row) {
                    $date = date('d-m-Y', strtotime($row->created_at));
                    return $date;
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '       <td class="text-center">
                    <ul class="table-controls">
                    <li><a href="javascript:void(0);" id="' . $row->id_per . '" class="editIcon" data-bs-toggle="modal" data-bs-target="#editdataloyeeModal" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></a></li>     
                    <li><a href="javascript:void(0);" id="' . $row->id_per . '" class="deleteIcon" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 text-danger"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></a></li>                                                                                                                   
                    </ul>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
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
    public function delete(Request $request)
    {
        $id = $request->id;
        $kader = Perkembangan::find($id);
        $kader->delete();
        return Response()->json([
            'status' => 200,
            'messages' => 'Deleted Successfully'
        ]);
    }
}
