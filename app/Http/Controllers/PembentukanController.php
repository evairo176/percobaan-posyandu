<?php

namespace App\Http\Controllers;

use App\Models\Pembentukan;
use App\Models\User;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Validator;

class PembentukanController extends Controller
{
    public function index()
    {
        if (auth()->user()->posyandu_id) {
            $data = [
                'menu' => 'table',
                'submenu' => 'Input Rekap Pembentukan',
            ];
            // dd($data);
            return view('pages.backend.rekap-pembentukan', $data);
        } else {
            return redirect()->back();
        }
    }
    public function fetchAll(Request $request)
    {
        if (auth()->user()->posyandu_id) {
            if ($request->ajax()) {
                $data = Pembentukan::where('posyandu_id', auth()->user()->posyandu_id)->latest()->get();
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
        if ($request->pembentukan_id) {
            $validator  = Validator::make(request()->all(), [
                'tgl_musyawarah' => 'required',
                'psr_musyawarah' => 'required|numeric',
                'mtr_musyawarah' => 'required',
                'ksp_musyawarah' => 'required',
                'lurah' => 'required',
                'nomor' => 'required',
                'tgl' => 'required',
                'tentang' => 'required',
            ]);

            if ($validator->fails()) {
                // dd($validator->getMessageBag());
                return response()->json([
                    'status' => 400,
                    'messages' => $validator->getMessageBag()
                ]);
            } else {
                $pembentukan = Pembentukan::find($request->pembentukan_id);
                $pembentukanData = [
                    'posyandu_id' => auth()->user()->posyandu_id,
                    'tgl_musyawarah' => $request->tgl_musyawarah,
                    'psr_musyawarah' => $request->psr_musyawarah,
                    'mtr_musyawarah' => $request->mtr_musyawarah,
                    'ksp_musyawarah' => $request->ksp_musyawarah,
                    'lurah' => $request->lurah,
                    'nomor' => $request->nomor,
                    'tgl' => $request->tgl,
                    'tentang' => $request->tentang,
                ];
                // dd($pembentukanData);
                $pembentukan->update($pembentukanData);
                return response()->json([
                    'status' => 200,
                    'messages' => 'Updated Successfully'
                ]);
            }
        } else {
            $validator  = Validator::make(request()->all(), [
                'tgl_musyawarah' => 'required',
                'psr_musyawarah' => 'required|numeric',
                'mtr_musyawarah' => 'required',
                'ksp_musyawarah' => 'required',
                'lurah' => 'required',
                'nomor' => 'required',
                'tgl' => 'required',
                'tentang' => 'required',
            ]);

            if ($validator->fails()) {
                // dd($validator->getMessageBag());
                return response()->json([
                    'status' => 400,
                    'messages' => $validator->getMessageBag()
                ]);
            } else {
                $pembentukanData = [
                    'posyandu_id' => auth()->user()->posyandu_id,
                    'tgl_musyawarah' => $request->tgl_musyawarah,
                    'psr_musyawarah' => $request->psr_musyawarah,
                    'mtr_musyawarah' => $request->mtr_musyawarah,
                    'ksp_musyawarah' => $request->ksp_musyawarah,
                    'lurah' => $request->lurah,
                    'nomor' => $request->nomor,
                    'tgl' => $request->tgl,
                    'tentang' => $request->tentang,
                ];

                Pembentukan::create($pembentukanData);
                $user = User::find(auth()->user()->id);
                $userData = [
                    'posyandu_id' => auth()->user()->posyandu_id,
                    'status_pembentukan' => 'sudah',
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
        $user = Pembentukan::find($id);
        // dd($data->password);
        return response()->json($user);
    }
}
