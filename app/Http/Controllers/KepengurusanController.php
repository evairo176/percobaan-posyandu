<?php

namespace App\Http\Controllers;

use App\Models\Kepengurusan;
use App\Models\User;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Validator;

class KepengurusanController extends Controller
{
    public function index()
    {
        if (auth()->user()->posyandu_id) {
            $data = [
                'menu' => 'table',
                'submenu' => 'Input Rekap Kepengurusan',
            ];
            // dd($data);
            return view('pages.backend.rekap-kepengurusan', $data);
        } else {
            return redirect()->back();
        }
    }
    public function fetchAll(Request $request)
    {
        if (auth()->user()->posyandu_id) {
            if ($request->ajax()) {
                $data = Kepengurusan::where('posyandu_id', auth()->user()->posyandu_id)->latest()->get();
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
        if ($request->kepengurusan_id) {
            $validator  = Validator::make(request()->all(), [
                'ket_m' => 'required',
                'bend_m' => 'required|numeric',
                'sek_m' => 'required',
                'ket_kkp' => 'required',
                'bend_kkp' => 'required',
                'sek_kkp' => 'required',
                'ket_kkb' => 'required',
                'bend_kkb' => 'required',
                'sek_kkb' => 'required',
                'ket_kkbp' => 'required',
                'bend_kkbp' => 'required',
                'sek_kkbp' => 'required',
                'ket_kkbe' => 'required',
                'bend_kkbe' => 'required',
                'sek_kkbe' => 'required',
            ]);

            if ($validator->fails()) {
                // dd($validator->getMessageBag());
                return response()->json([
                    'status' => 400,
                    'messages' => $validator->getMessageBag()
                ]);
            } else {
                $kepengurusan = Kepengurusan::find($request->kepengurusan_id);
                $kepengurusanData = [
                    'posyandu_id' => auth()->user()->posyandu_id,
                    'ket_m' => $request->ket_m,
                    'bend_m' => $request->bend_m,
                    'sek_m' => $request->sek_m,
                    'ket_kkp' => $request->ket_kkp,
                    'bend_kkp' => $request->bend_kkp,
                    'sek_kkp' => $request->sek_kkp,
                    'ket_kkb' => $request->ket_kkb,
                    'bend_kkb' => $request->bend_kkb,
                    'sek_kkb' => $request->sek_kkb,
                    'ket_kkbp' => $request->ket_kkbp,
                    'bend_kkbp' => $request->bend_kkbp,
                    'sek_kkbp' => $request->sek_kkbp,
                    'ket_kkbe' => $request->ket_kkbe,
                    'bend_kkbe' => $request->bend_kkbe,
                    'sek_kkbe' => $request->sek_kkbe,
                ];
                // dd($kepengurusanData);
                $kepengurusan->update($kepengurusanData);
                return response()->json([
                    'status' => 200,
                    'messages' => 'Updated Successfully'
                ]);
            }
        } else {
            $validator  = Validator::make(request()->all(), [
                'ket_m' => 'required',
                'bend_m' => 'required',
                'sek_m' => 'required',
                'ket_kkp' => 'required',
                'bend_kkp' => 'required',
                'sek_kkp' => 'required',
                'ket_kkb' => 'required',
                'bend_kkb' => 'required',
                'sek_kkb' => 'required',
                'ket_kkbp' => 'required',
                'bend_kkbp' => 'required',
                'sek_kkbp' => 'required',
                'ket_kkbe' => 'required',
                'bend_kkbe' => 'required',
                'sek_kkbe' => 'required',
            ]);

            if ($validator->fails()) {
                // dd($validator->getMessageBag());
                return response()->json([
                    'status' => 400,
                    'messages' => $validator->getMessageBag()
                ]);
            } else {
                $kepengurusanData = [
                    'posyandu_id' => auth()->user()->posyandu_id,
                    'ket_m' => $request->ket_m,
                    'bend_m' => $request->bend_m,
                    'sek_m' => $request->sek_m,
                    'ket_kkp' => $request->ket_kkp,
                    'bend_kkp' => $request->bend_kkp,
                    'sek_kkp' => $request->sek_kkp,
                    'ket_kkb' => $request->ket_kkb,
                    'bend_kkb' => $request->bend_kkb,
                    'sek_kkb' => $request->sek_kkb,
                    'ket_kkbp' => $request->ket_kkbp,
                    'bend_kkbp' => $request->bend_kkbp,
                    'sek_kkbp' => $request->sek_kkbp,
                    'ket_kkbe' => $request->ket_kkbe,
                    'bend_kkbe' => $request->bend_kkbe,
                    'sek_kkbe' => $request->sek_kkbe,
                ];
                // dd($kepengurusanData);
                Kepengurusan::create($kepengurusanData);
                $user = User::find(auth()->user()->id);
                $userData = [
                    'posyandu_id' => auth()->user()->posyandu_id,
                    'status_kepengurusan' => 'sudah',
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
        $user = Kepengurusan::find($id);
        // dd($data->password);
        return response()->json($user);
    }
}
