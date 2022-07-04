<?php

namespace App\Http\Controllers;

use App\Models\Demografi;
use App\Models\User;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Validator;

class DemografiController extends Controller
{
    public function index()
    {
        if (auth()->user()->posyandu_id) {
            $data = [
                'menu' => 'table',
                'submenu' => 'Input Rekap Demografi',
            ];
            // dd($data);
            return view('pages.backend.rekap-demografi', $data);
        } else {
            return redirect()->back();
        }
    }
    public function fetchAll(Request $request)
    {
        if (auth()->user()->posyandu_id) {
            if ($request->ajax()) {
                $data = Demografi::where('posyandu_id', auth()->user()->posyandu_id)->latest()->get();
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
        if ($request->demografi_id) {
            $validator  = Validator::make(request()->all(), [
                'jml_kpl_klg' => 'required|numeric',
                'jml_pdd' => 'required|numeric',
                'jml_pdd_l' => 'required|numeric',
                'jml_pdd_p' => 'required|numeric',
                'jml_pus' => 'required|numeric',
                'jml_wus' => 'required|numeric',
                'jml_ibu_hml' => 'required|numeric',
                'jml_bayi_d' => 'required|numeric',
                'jml_balita_d' => 'required|numeric',
            ]);

            if ($validator->fails()) {
                // dd($validator->getMessageBag());
                return response()->json([
                    'status' => 400,
                    'messages' => $validator->getMessageBag()
                ]);
            } else {
                $demografi = Demografi::find($request->demografi_id);
                $demografiData = [
                    'posyandu_id' => auth()->user()->posyandu_id,
                    'jml_kpl_klg' => $request->jml_kpl_klg,
                    'jml_pdd' => $request->jml_pdd,
                    'jml_pdd_l' => $request->jml_pdd_l,
                    'jml_pdd_p' => $request->jml_pdd_p,
                    'jml_pus' => $request->jml_pus,
                    'jml_wus' => $request->jml_wus,
                    'jml_ibu_hml' => $request->jml_ibu_hml,
                    'jml_bayi_d' => $request->jml_bayi_d,
                    'jml_balita_d' => $request->jml_balita_d,
                ];
                // dd($demografiData);
                $demografi->update($demografiData);
                return response()->json([
                    'status' => 200,
                    'messages' => 'Updated Successfully'
                ]);
            }
        } else {
            $validator  = Validator::make(request()->all(), [
                'jml_kpl_klg' => 'required|numeric',
                'jml_pdd' => 'required|numeric',
                'jml_pdd_l' => 'required|numeric',
                'jml_pdd_p' => 'required|numeric',
                'jml_pus' => 'required|numeric',
                'jml_wus' => 'required|numeric',
                'jml_ibu_hml' => 'required|numeric',
                'jml_bayi_d' => 'required|numeric',
                'jml_balita_d' => 'required|numeric',
            ]);

            if ($validator->fails()) {
                // dd($validator->getMessageBag());
                return response()->json([
                    'status' => 400,
                    'messages' => $validator->getMessageBag()
                ]);
            } else {
                $demografiData = [
                    'posyandu_id' => auth()->user()->posyandu_id,
                    'jml_kpl_klg' => $request->jml_kpl_klg,
                    'jml_pdd' => $request->jml_pdd,
                    'jml_pdd_l' => $request->jml_pdd_l,
                    'jml_pdd_p' => $request->jml_pdd_p,
                    'jml_pus' => $request->jml_pus,
                    'jml_wus' => $request->jml_wus,
                    'jml_ibu_hml' => $request->jml_ibu_hml,
                    'jml_bayi_d' => $request->jml_bayi_d,
                    'jml_balita_d' => $request->jml_balita_d,
                ];

                Demografi::create($demografiData);
                $user = User::find(auth()->user()->id);
                $userData = [
                    'posyandu_id' => auth()->user()->posyandu_id,
                    'status_demografi' => 'sudah',
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
    public function edit(Request $request)
    {
        $id = $request->id;
        // dd($id);
        $user = Demografi::find($id);
        // dd($data->password);
        return response()->json($user);
    }
}
