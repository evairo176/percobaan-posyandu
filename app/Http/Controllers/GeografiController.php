<?php

namespace App\Http\Controllers;

use App\Models\Geografi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DataTables;

class GeografiController extends Controller
{
    public function index()
    {
        $data = [
            'menu' => 'table',
            'submenu' => 'Input Rekap Geografi',
        ];
        // dd($data);
        return view('pages.backend.rekap-geografi', $data);
    }
    public function fetchAll(Request $request)
    {
        if (auth()->user()->posyandu_id) {
            if ($request->ajax()) {
                $data = Geografi::where('posyandu_id', auth()->user()->posyandu_id)->latest()->get();
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('created_at', function ($row) {
                        $date = date('d-m-Y', strtotime($row->created_at));
                        return $date;
                    })
                    ->addColumn('action', function ($row) {
                        $actionBtn = '       <td class="text-center">
                    <ul class="table-controls">
                    <li><a href="javascript:void(0);" id="' . $row->id . '" class="editIcon" data-bs-toggle="modal" data-bs-target="#editdataloyeeModal" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 text-success"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a></li>                                       
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
        if ($request->geografi_id) {
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
            ]);

            if ($validator->fails()) {
                // dd($validator->getMessageBag());
                return response()->json([
                    'status' => 400,
                    'messages' => $validator->getMessageBag()
                ]);
            } else {
                $geografi = Geografi::find($request->geografi_id);
                $geografiData = [
                    'posyandu_id' => auth()->user()->posyandu_id,
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
                ];
                // dd($geografiData);
                $geografi->update($geografiData);
                return response()->json([
                    'status' => 200,
                    'messages' => 'Updated Successfully'
                ]);
            }
        } else {
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
            ]);

            if ($validator->fails()) {
                // dd($validator->getMessageBag());
                return response()->json([
                    'status' => 400,
                    'messages' => $validator->getMessageBag()
                ]);
            } else {
                $geografiData = [
                    'posyandu_id' => auth()->user()->posyandu_id,
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
                ];

                Geografi::create($geografiData);
                $user = User::find(auth()->user()->id);
                $userData = [
                    'posyandu_id' => auth()->user()->posyandu_id,
                    'status_geografi' => 'sudah',
                ];
                $user->update($userData);
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
            $geografi = Geografi::find($request->geografi_id);
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
        $user = Geografi::find($id);
        // dd($data->password);
        return response()->json($user);
    }
}
