<?php

namespace App\Http\Controllers;

use App\Models\Sarana;
use App\Models\User;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Validator;

class SaranaController extends Controller
{
    public function index()
    {
        if (auth()->user()->posyandu_id) {
            $data = [
                'menu' => 'table',
                'submenu' => 'Input Rekap Sarana',
            ];
            // dd($data);
            return view('pages.backend.rekap-sarana', $data);
        } else {
            return redirect()->back();
        }
    }
    public function fetchAll(Request $request)
    {
        if (auth()->user()->posyandu_id) {
            if ($request->ajax()) {
                $data = Sarana::where('posyandu_id', auth()->user()->posyandu_id)->latest()->get();
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
        if ($request->sarana_id) {

            $validator  = Validator::make(request()->all(), [
                'status_g' => 'required',
                'th_bgn_g' => 'required|numeric',
                'keadaan_g' => 'required',
                'luas_g' => 'required',
                'konstruksi_g' => 'required',
                'sdp_g' => 'required',
                'dacin_k' => 'required',
                'tb_k' => 'required',
                'ti_k' => 'required',
                'pl_k' => 'required',
                'autb_k' => 'required',
                'aupb_k' => 'required',
                'ape_k' => 'required',
                'sp_k' => 'required',
                'fm_k' => 'required',
                'm_k' => 'required',
                'pn_k' => 'required',
            ]);

            if ($validator->fails()) {
                // dd($validator->getMessageBag());
                return response()->json([
                    'status' => 400,
                    'messages' => $validator->getMessageBag()
                ]);
            } else {
                $sarana = Sarana::find($request->sarana_id);
                $saranaData = [
                    'posyandu_id' => auth()->user()->posyandu_id,
                    'status_g' => $request->status_g,
                    'th_bgn_g' => $request->th_bgn_g,
                    'keadaan_g' => $request->keadaan_g,
                    'luas_g' => $request->luas_g,
                    'konstruksi_g' => $request->konstruksi_g,
                    'sdp_g' => $request->sdp_g,
                    'dacin_k' => serialize($request->dacin_k),
                    'tb_k' => serialize($request->tb_k),
                    'ti_k' => serialize($request->ti_k),
                    'pl_k' => serialize($request->pl_k),
                    'autb_k' => serialize($request->autb_k),
                    'aupb_k' => serialize($request->aupb_k),
                    'ape_k' => serialize($request->ape_k),
                    'sp_k' => serialize($request->sp_k),
                    'fm_k' => serialize($request->fm_k),
                    'm_k' => serialize($request->m_k),
                    'pn_k' => serialize($request->pn_k),
                ];

                $sarana->update($saranaData);
                return response()->json([
                    'status' => 200,
                    'messages' => 'Updated Successfully'
                ]);
            }
        } else {
            // dd($request->all());
            $validator  = Validator::make(request()->all(), [
                'status_g' => 'required',
                'th_bgn_g' => 'required',
                'keadaan_g' => 'required',
                'luas_g' => 'required',
                'konstruksi_g' => 'required',
                'sdp_g' => 'required',
                'dacin_k' => 'required',
                'tb_k' => 'required',
                'ti_k' => 'required',
                'pl_k' => 'required',
                'autb_k' => 'required',
                'aupb_k' => 'required',
                'ape_k' => 'required',
                'sp_k' => 'required',
                'fm_k' => 'required',
                'm_k' => 'required',
                'pn_k' => 'required',
            ]);

            if ($validator->fails()) {
                // dd($validator->getMessageBag());
                return response()->json([
                    'status' => 400,
                    'messages' => $validator->getMessageBag()
                ]);
            } else {
                $saranaData = [
                    'posyandu_id' => auth()->user()->posyandu_id,
                    'status_g' => $request->status_g,
                    'th_bgn_g' => $request->th_bgn_g,
                    'keadaan_g' => $request->keadaan_g,
                    'luas_g' => $request->luas_g,
                    'konstruksi_g' => $request->konstruksi_g,
                    'sdp_g' => $request->sdp_g,
                    'dacin_k' => serialize($request->dacin_k),
                    'tb_k' => serialize($request->tb_k),
                    'ti_k' => serialize($request->ti_k),
                    'pl_k' => serialize($request->pl_k),
                    'autb_k' => serialize($request->autb_k),
                    'aupb_k' => serialize($request->aupb_k),
                    'ape_k' => serialize($request->ape_k),
                    'sp_k' => serialize($request->sp_k),
                    'fm_k' => serialize($request->fm_k),
                    'm_k' => serialize($request->m_k),
                    'pn_k' => serialize($request->pn_k),
                ];
                // dd($saranaData);
                Sarana::create($saranaData);
                $user = User::find(auth()->user()->id);
                $userData = [
                    'posyandu_id' => auth()->user()->posyandu_id,
                    'status_sarana' => 'sudah',
                ];
                $user->update($userData);
                // dd($userData);
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
        $user = Sarana::find($id);
        // dd($data->password);
        return response()->json($user);
    }
}
