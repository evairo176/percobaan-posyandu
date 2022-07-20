<?php

namespace App\Http\Controllers;

use App\Models\Kader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DataTables;
use Illuminate\Support\Carbon;

class KaderController extends Controller
{
    public function index()
    {
        if (auth()->user()->posyandu_id) {
            $data = [
                'menu' => 'table',
                'submenu' => 'Input Rekap Kader',
            ];
            // dd($data);
            return view('pages.backend.rekap-kader', $data);
        } else {
            return redirect()->back();
        }
    }
    public function fetchAll(Request $request)
    {
        if (auth()->user()->posyandu_id) {
            if ($request->ajax()) {
                $data = Kader::where('posyandu_id', auth()->user()->posyandu_id)->latest()->get();
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('umur', function ($row) {
                        $dateOfBirth = $row->umur;
                        $years = Carbon::parse($dateOfBirth)->age;

                        // dd($years);
                        return $years;
                    })
                    ->addColumn('created_at', function ($row) {
                        $date = date('d-m-Y', strtotime($row->created_at));
                        return $date;
                    })
                    ->addColumn('action', function ($row) {
                        $actionBtn = '       <td class="text-center">
                    <ul class="table-controls">
                    <li><a href="javascript:void(0);" id="' . $row->id . '" class="editIcon" data-bs-toggle="modal" data-bs-target="#editdataloyeeModal" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 text-success"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a></li>
                    <li><a href="javascript:void(0);" id="' . $row->id . '" class="deleteIcon" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 text-danger"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></a></li>                                                                                 
                     </ul>';
                        return $actionBtn;
                    })
                    ->rawColumns(['umur', 'action'])
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
        if ($request->kader_id) {
            $validator  = Validator::make(request()->all(), [
                'nama_kader' => 'required',
                'umur' => 'required',
                'tahun_jadi_kader' => 'required',
                'terlatih' => 'required',
                'pendidikan' => 'required',
                'tahun_pelatihan' => 'required',
                'no_hp' => 'required|numeric',
            ]);

            if ($validator->fails()) {
                // dd($validator->getMessageBag());
                return response()->json([
                    'status' => 400,
                    'messages' => $validator->getMessageBag()
                ]);
            } else {
                $kader = Kader::find($request->kader_id);
                $kaderData = [
                    'posyandu_id' => auth()->user()->posyandu_id,
                    'nama_kader' => $request->nama_kader,
                    'umur' => $request->umur,
                    'tahun_jadi_kader' => $request->tahun_jadi_kader,
                    'terlatih' => $request->terlatih,
                    'pendidikan' => $request->pendidikan,
                    'tahun_pelatihan' => $request->tahun_pelatihan,
                    'no_hp' => $request->no_hp,
                ];
                // dd($kaderData);
                $kader->update($kaderData);
                return response()->json([
                    'status' => 200,
                    'messages' => 'Updated Successfully'
                ]);
            }
        } else {
            $validator  = Validator::make(request()->all(), [
                'nama_kader' => 'required',
                'umur' => 'required',
                'tahun_jadi_kader' => 'required',
                'pendidikan' => 'required',
                'terlatih' => 'required',
                'tahun_pelatihan' => 'required',
                'no_hp' => 'required|numeric',
            ]);

            if ($validator->fails()) {
                // dd($validator->getMessageBag());
                return response()->json([
                    'status' => 400,
                    'messages' => $validator->getMessageBag()
                ]);
            } else {
                $kaderData = [
                    'posyandu_id' => auth()->user()->posyandu_id,
                    'nama_kader' => $request->nama_kader,
                    'umur' => $request->umur,
                    'terlatih' => $request->terlatih,
                    'tahun_jadi_kader' => $request->tahun_jadi_kader,
                    'pendidikan' => $request->pendidikan,
                    'tahun_pelatihan' => $request->tahun_pelatihan,
                    'no_hp' => $request->no_hp,
                ];

                Kader::create($kaderData);
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
        $user = Kader::find($id);
        // dd($data->password);
        return response()->json($user);
    }
    public function delete(Request $request)
    {
        $id = $request->id;
        $kader = Kader::find($id);
        $kader->delete();
        return Response()->json([
            'status' => 200,
            'messages' => 'Deleted Successfully'
        ]);
    }
}
