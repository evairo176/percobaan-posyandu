<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DataTables;

class KegiatanController extends Controller
{
    public function index()
    {
        if (auth()->user()->posyandu_id) {
            $data = [
                'menu' => 'table',
                'submenu' => 'Input Rekap Kegiatan',
            ];
            // dd($data);
            return view('pages.backend.rekap-kegiatan', $data);
        } else {
            return redirect()->back();
        }
    }
    public function fetchAll(Request $request)
    {
        if (auth()->user()->posyandu_id) {
            if ($request->ajax()) {
                $data = Kegiatan::where('posyandu_id', auth()->user()->posyandu_id)->latest()->get();
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
        if ($request->kegiatan_id) {
            $validator  = Validator::make(request()->all(), [
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
            ]);

            if ($validator->fails()) {
                // dd($validator->getMessageBag());
                return response()->json([
                    'status' => 400,
                    'messages' => $validator->getMessageBag()
                ]);
            } else {
                $kegiatan = Kegiatan::find($request->kegiatan_id);
                $kegiatanData = [
                    'posyandu_id' => auth()->user()->posyandu_id,
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
                ];
                // dd($kegiatanData);
                $kegiatan->update($kegiatanData);
                return response()->json([
                    'status' => 200,
                    'messages' => 'Updated Successfully'
                ]);
            }
        } else {
            $validator  = Validator::make(request()->all(), [
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
            ]);

            if ($validator->fails()) {
                // dd($validator->getMessageBag());
                return response()->json([
                    'status' => 400,
                    'messages' => $validator->getMessageBag()
                ]);
            } else {
                $kegiatanData = [
                    'posyandu_id' => auth()->user()->posyandu_id,
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
                ];

                Kegiatan::create($kegiatanData);
                $user = User::find(auth()->user()->id);
                $userData = [
                    'posyandu_id' => auth()->user()->posyandu_id,
                    'status_kegiatan' => 'sudah',
                ];
                $user->update($userData);
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
        $user = Kegiatan::find($id);
        // dd($data->password);
        return response()->json($user);
    }
}
