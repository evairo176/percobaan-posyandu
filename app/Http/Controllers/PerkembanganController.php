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
                $strata = DB::table('tb_strata')->where('posyandu_id', auth()->user()->posyandu_id)->first();
                $kader = DB::table('tb_kader')->where('posyandu_id', auth()->user()->posyandu_id)->count();
                $skdn = DB::table('tb_skdn')->where('posyandu_id', auth()->user()->posyandu_id)->first();
                $kegiatan = DB::table('tb_kegiatan_utama')->where('posyandu_id', auth()->user()->posyandu_id)->first();
                $program = DB::table('tb_program')->where('posyandu_id', auth()->user()->posyandu_id)->first();
                // dd($perkembangan->toArray());
                $data = [
                    'menu' => 'table',
                    'submenu' => 'Input Rekap Perkembangan',
                    'perkembangan' => $perkembangan,
                    'pos' => $posyandu,
                    'strata' => $strata,
                    'kader' => $kader,
                    'skdn' => $skdn,
                    'kegiatan' => $kegiatan,
                    'program' => $program,
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
        // dd($request->all());
        if ($request->perkembangan_id) {
            $validator  = Validator::make(request()->all(), [
                'tahun_rekap' => 'required|numeric',
                'pra' => 'required|numeric',
                'mad' => 'required|numeric',
                'pur' => 'required|numeric',
                'man' => 'required|numeric',
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
                'paud' => 'required|numeric',
                'bkb' => 'required|numeric',
                'bkr' => 'required|numeric',
                'bkl' => 'required|numeric',
                'up2k' => 'required|numeric',
                'as' => 'required|numeric',
                'in' => 'required|numeric',
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
                    'kelurahan_id' => $request->kelurahan_id,
                    'kecamatan_id' => $request->kecamatan_id,
                    'tahun_rekap' => $request->tahun_rekap,
                    'pra' => $request->pra,
                    'mad' => $request->mad,
                    'pur' => $request->pur,
                    'man' => $request->man,
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
                'pra' => 'required|numeric',
                'mad' => 'required|numeric',
                'pur' => 'required|numeric',
                'man' => 'required|numeric',
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
                'paud' => 'required|numeric',
                'bkb' => 'required|numeric',
                'bkr' => 'required|numeric',
                'bkl' => 'required|numeric',
                'up2k' => 'required|numeric',
                'as' => 'required|numeric',
                'in' => 'required|numeric',
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
                    'kelurahan_id' => $request->kelurahan_id,
                    'kecamatan_id' => $request->kecamatan_id,
                    'tahun_rekap' => $request->tahun_rekap,
                    'pra' => $request->pra,
                    'mad' => $request->mad,
                    'pur' => $request->pur,
                    'man' => $request->man,
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
}
