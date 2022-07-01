<?php

namespace App\Http\Controllers;

use App\Models\Geografi;
use App\Models\Posyandu;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use DataTables;
use Illuminate\Support\Facades\Storage;
use PDF;

class RekapPosyanduControler extends Controller
{
    public function index()
    {
        $data = [
            'menu' => 'table',
            'submenu' => 'Input Rekap Posyandu',
        ];
        // dd($data);
        return view('pages.backend.rekap-posyandu', $data);
    }
    public function fetchAll(Request $request)
    {
        if (auth()->user()->role == 'petugas') {
            if (auth()->user()->posyandu_id) {
                if ($request->ajax()) {
                    $data = Posyandu::where('id', auth()->user()->posyandu_id)->latest()->get();
                    return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('created_at', function ($row) {
                            $date = date('d-m-Y', strtotime($row->created_at));
                            return $date;
                        })
                        ->addColumn('action', function ($row) {
                            $actionBtn = '       <td class="text-center">
                        <ul class="table-controls">
                        <li><a href="posyandu/detail/' . $row->id . '" id="" class="detailIcon btn btn-secondary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Settings"><i class="fas fa-print"></i> Print</a> </li>
                        <li><a href="javascript:void(0);" id="' . $row->id . '" class="editIcon" data-bs-toggle="modal" data-bs-target="#editdataloyeeModal" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 text-success"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a></li>                                       
                         </ul>';
                            return $actionBtn;
                        })
                        ->rawColumns(['picture', 'action'])
                        ->make(true);
                }
            } else {
                return response()->json([
                    'status' => 201,
                    'messages' => 'Data Tidak ada'
                ]);
            }
        } else {
            if ($request->ajax()) {
                $data = Posyandu::latest()->get();
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('created_at', function ($row) {
                        $date = date('d-m-Y', strtotime($row->created_at));
                        return $date;
                    })
                    ->addColumn('action', function ($row) {
                        $actionBtn = '       <td class="text-center">
                    <ul class="table-controls">
                    <li><a href="posyandu/detail/' . $row->id . '" id="" class="detailIcon btn btn-secondary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Settings"><i class="fas fa-print"></i> Print</a> </li>
                    <li><a href="javascript:void(0);" id="' . $row->id . '" class="editIcon" data-bs-toggle="modal" data-bs-target="#editdataloyeeModal" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 text-success"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a></li>                                       
                     </ul>';
                        return $actionBtn;
                    })
                    ->rawColumns(['picture', 'action'])
                    ->make(true);
            }
        }
    }

    public function store(Request $request)
    {
        if ($request->posyandu_id) {
            $validator  = Validator::make(request()->all(), [
                'nama_posyandu' => 'required',
                'blok' => 'required',
                'rt' => 'required|numeric',
                'rw' => 'required|numeric',
                'kelurahan' => 'required',
                'kecamatan' => 'required',
                'kabupaten' => 'required',
            ]);

            if ($validator->fails()) {
                // dd($validator->getMessageBag());
                return response()->json([
                    'status' => 400,
                    'messages' => $validator->getMessageBag()
                ]);
            } else {
                $posyandu = Posyandu::find($request->posyandu_id);
                $posyanduData = [
                    'nama_posyandu' => $request->nama_posyandu,
                    'blok' => $request->blok,
                    'rt' => $request->rt,
                    'rw' => $request->rw,
                    'kelurahan' => $request->kelurahan,
                    'kecamatan' => $request->kecamatan,
                    'kabupaten' => $request->kabupaten,
                ];
                // dd($posyanduData);
                $posyandu->update($posyanduData);
                return response()->json([
                    'status' => 200,
                    'messages' => 'Updated Successfully'
                ]);
            }
        } else {
            $validator  = Validator::make(request()->all(), [
                'nama_posyandu' => 'required',
                'blok' => 'required',
                'rt' => 'required|numeric',
                'rw' => 'required|numeric',
                'kelurahan' => 'required',
                'kecamatan' => 'required',
                'kabupaten' => 'required',
            ]);

            if ($validator->fails()) {
                // dd($validator->getMessageBag());
                return response()->json([
                    'status' => 400,
                    'messages' => $validator->getMessageBag()
                ]);
            } else {
                $posyanduData = [
                    'nama_posyandu' => $request->nama_posyandu,
                    'blok' => $request->blok,
                    'rt' => $request->rt,
                    'rw' => $request->rw,
                    'kelurahan' => $request->kelurahan,
                    'kecamatan' => $request->kecamatan,
                    'kabupaten' => $request->kabupaten,
                ];
                // dd($posyanduData);

                $pos = Posyandu::create($posyanduData);
                // dd($pos->id);
                $user = User::find(auth()->user()->id);
                $userData = [
                    'posyandu_id' => $pos->id,
                    'status_posyandu' => 'sudah',
                ];
                $user->update($userData);
                // dd($user);
                return response()->json([
                    'status' => 200,
                    'messages' => 'Updated Successfully'
                ]);
            }
        }
    }
    public function geografiSave(Request $request)
    {
        $validator  = Validator::make(request()->all(), [
            'jml_rt' => 'required|numeric',
            'jml_rw' => 'required|numeric',
            'jrk_terdekat' => 'required|numeric',
            'jrk_terjauh' => 'required|numeric',
            'polindes' => 'required|numeric',
            'pks_pembantu' => 'required|numeric',
            'pks' => 'required|numeric',
            'pkt_dokter' => 'required|numeric',
            'klinik' => 'required|numeric',
            'rumah_sakit' => 'required|numeric',
            'kelurahan_g' => 'required|numeric',
            'kecamatan_g' => 'required|numeric',
            'kabupaten_g' => 'required|numeric',
            'provinsi_g' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            // dd($validator->getMessageBag());
            return response()->json([
                'status' => 400,
                'messages' => $validator->getMessageBag()
            ]);
        } else {
            $geografi = Posyandu::find($request->geografi_id);
            $geografiData = [
                'jml_rt' => $request->jml_rt,
                'jml_rw' => $request->jml_rw,
                'jrk_terdekat' => $request->jrk_terdekat,
                'jrk_terjauh' => $request->jrk_terjauh,
                'polindes' => $request->polindes,
                'pks_pembantu' => $request->pks_pembantu,
                'pks' => $request->pks,
                'pkt_dokter' => $request->pkt_dokter,
                'klinik' => $request->klinik,
                'rumah_sakit' => $request->rumah_sakit,
                'kelurahan_g' => $request->kelurahan_g,
                'kecamatan_g' => $request->kecamatan_g,
                'kabupaten_g' => $request->kabupaten_g,
                'provinsi_g' => $request->provinsi_g,
            ];
            // dd($geografiData);
            $geografi->update($geografiData);
            return response()->json([
                'status' => 200,
                'messages' => 'Updated Successfully'
            ]);
        }
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        // dd($id);
        $user = Posyandu::find($id);
        // dd($data->password);
        return response()->json($user);
    }
    public function detail($id_posyandu)
    {
        $id = $id_posyandu;
        // dd($id);
        // DB::table('tb_kegiatan_utama')
        //     ->leftJoin('tb_posyandu', 'tb_kegiatan_utama.id_posyandu', '=', 'tb_posyandu.id')
        //     ->select(
        //         'tb_kegiatan_utama.*',
        //         'tb_posyandu.*',
        //         'tb_kegiatan_utama.id as id_kegiatan_utama',
        //     )
        //     ->orderBy('id_kegiatan_utama', 'desc')
        //     ->get();
        $data = [
            'menu' => 'table',
            'submenu' => 'Input Rekap Posyandu',
            'pos' =>  DB::table('tb_rekap_posyandu')
                ->leftJoin('tb_geografi', 'tb_rekap_posyandu.id', '=', 'tb_geografi.posyandu_id')
                ->leftJoin('tb_demografi', 'tb_rekap_posyandu.id', '=', 'tb_demografi.posyandu_id')
                ->select(
                    'tb_rekap_posyandu.*',
                    'tb_geografi.*',
                    'tb_demografi.*',
                    'tb_rekap_posyandu.id as id_posyandu',
                )->where('tb_rekap_posyandu.id', auth()->user()->posyandu_id)
                ->first(),
        ];
        // dd($data);
        return view('pages.backend.detail-posyandu', $data);
    }
    public function cetakPdf($id_posyandu)
    {
        $posyandu = Posyandu::find($id_posyandu);
        $data = [
            'menu' => 'table',
            'submenu' => 'Input Rekap Posyandu',
            'pos' =>  $posyandu,
        ];
        // $pdf = PDF::loadView('pages.backend.cetakPdf', $data);
        // return $pdf->download('data-' . $posyandu->nama_posyandu . '.pdf');
        return view('pages.backend.cetakPdf', $data);
    }
}
