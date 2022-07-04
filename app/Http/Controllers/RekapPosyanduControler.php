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
                        <li><a href="posyandu/cetak-pdf/' . $row->id . '" id="" class="detailIcon" data-toggle="tooltip" data-placement="top" title="" data-original-title="Settings"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg></a> </li>
                        <li><a href="javascript:void(0);" id="' . $row->id . '" class="editIcon" data-bs-toggle="modal" data-bs-target="#editdataloyeeModal" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 text-success"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a></li>                                       
                         </ul>';
                            return $actionBtn;
                        })
                        ->rawColumns(['picture', 'action'])
                        ->make(true);
                    // <li><a href="posyandu/detail/' . $row->id . '" id="" class="detailIcon btn btn-secondary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Settings"><i class="fas fa-print"></i> Print</a> </li>

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
                    <li><a href="posyandu/cetak-pdf/' . $row->id . '" id="" class="detailIcon" data-toggle="tooltip" data-placement="top" title="" data-original-title="Settings"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg></a> </li>
                    <li><a href="javascript:void(0);" id="' . $row->id . '" class="editIcon" data-bs-toggle="modal" data-bs-target="#editdataloyeeModal" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 text-success"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a></li>  
                    </ul>';
                        return $actionBtn;
                    })
                    ->rawColumns(['picture', 'action'])
                    ->make(true);
                // <li><a href="javascript:void(0);" id="' . $row->id . '" class="deleteIcon" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 text-danger"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></a></li>                                                                              
                // <li><a href="posyandu/detail/' . $row->id . '" id="" class="detailIcon btn btn-secondary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Settings"><i class="fas fa-print"></i> Print</a> </li>
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

        $data = [
            'menu' => 'table',
            'submenu' => 'Input Rekap Posyandu',
            'pos' =>  DB::table('tb_rekap_posyandu')
                ->leftJoin('tb_geografi', 'tb_rekap_posyandu.id', '=', 'tb_geografi.posyandu_id')
                ->leftJoin('tb_demografi', 'tb_rekap_posyandu.id', '=', 'tb_demografi.posyandu_id')
                ->leftJoin('tb_pembentukan', 'tb_rekap_posyandu.id', '=', 'tb_pembentukan.posyandu_id')
                ->leftJoin('tb_kepengurusan', 'tb_rekap_posyandu.id', '=', 'tb_kepengurusan.posyandu_id')
                ->select(
                    'tb_rekap_posyandu.*',
                    'tb_geografi.*',
                    'tb_demografi.*',
                    'tb_pembentukan.*',
                    'tb_kepengurusan.*',
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
            'pos' =>  DB::table('tb_rekap_posyandu')
                ->leftJoin('tb_geografi', 'tb_rekap_posyandu.id', '=', 'tb_geografi.posyandu_id')
                ->leftJoin('tb_demografi', 'tb_rekap_posyandu.id', '=', 'tb_demografi.posyandu_id')
                ->leftJoin('tb_pembentukan', 'tb_rekap_posyandu.id', '=', 'tb_pembentukan.posyandu_id')
                ->leftJoin('tb_kepengurusan', 'tb_rekap_posyandu.id', '=', 'tb_kepengurusan.posyandu_id')
                ->leftJoin('tb_sarana', 'tb_rekap_posyandu.id', '=', 'tb_sarana.posyandu_id')
                ->select(
                    'tb_rekap_posyandu.*',
                    'tb_geografi.*',
                    'tb_demografi.*',
                    'tb_pembentukan.*',
                    'tb_kepengurusan.*',
                    'tb_sarana.*',
                    'tb_rekap_posyandu.id as id_posyandu',
                )->where('tb_rekap_posyandu.id', auth()->user()->posyandu_id)
                ->first(),
        ];
        $pdf = PDF::loadView('pages.backend.cetakPdf', $data);
        return $pdf->download('data-' . $posyandu->nama_posyandu . '.pdf');
        // return view('pages.backend.cetakPdf', $data);
    }

    public function detailAll()
    {

        $data = [
            'menu' => 'table',
            'submenu' => 'Input Rekap Posyandu',
            'pos' =>  DB::table('tb_rekap_posyandu')
                ->leftJoin('tb_geografi', 'tb_rekap_posyandu.id', '=', 'tb_geografi.posyandu_id')
                ->leftJoin('tb_demografi', 'tb_rekap_posyandu.id', '=', 'tb_demografi.posyandu_id')
                ->leftJoin('tb_pembentukan', 'tb_rekap_posyandu.id', '=', 'tb_pembentukan.posyandu_id')
                ->leftJoin('tb_kepengurusan', 'tb_rekap_posyandu.id', '=', 'tb_kepengurusan.posyandu_id')
                ->select(
                    'tb_rekap_posyandu.*',
                    'tb_geografi.*',
                    'tb_demografi.*',
                    'tb_pembentukan.*',
                    'tb_kepengurusan.*',
                    'tb_rekap_posyandu.id as id_posyandu',
                )
                ->get(),
        ];
        // dd($data);
        return view('pages.backend.detail-posyandu-all', $data);
    }
    public function cetakPdfAll()
    {
        $data = [
            'menu' => 'table',
            'submenu' => 'Input Rekap Posyandu',
            'pos' =>  DB::table('tb_rekap_posyandu')
                ->leftJoin('tb_geografi', 'tb_rekap_posyandu.id', '=', 'tb_geografi.posyandu_id')
                ->leftJoin('tb_demografi', 'tb_rekap_posyandu.id', '=', 'tb_demografi.posyandu_id')
                ->leftJoin('tb_pembentukan', 'tb_rekap_posyandu.id', '=', 'tb_pembentukan.posyandu_id')
                ->leftJoin('tb_kepengurusan', 'tb_rekap_posyandu.id', '=', 'tb_kepengurusan.posyandu_id')
                ->select(
                    'tb_rekap_posyandu.*',
                    'tb_geografi.*',
                    'tb_demografi.*',
                    'tb_pembentukan.*',
                    'tb_kepengurusan.*',
                    'tb_rekap_posyandu.id as id_posyandu',
                )
                ->get(),
        ];
        $pdf = PDF::loadView('pages.backend.cetakPdfAll', $data);
        return $pdf->download('data-' . 'semua-data-posyandu' . '.pdf');
        // return view('pages.backend.cetakPdf', $data);
    }
    // handle delete an dataloyee ajax request
    public function delete(Request $request)
    {
        $id = $request->id;
        $posyandu = Posyandu::find($id);
        $user = User::where('posyandu_id', $id)->first();
        // dd($user);
        $posyandu->delete();
        return Response()->json([
            'status' => 200,
            'messages' => 'Deleted Successfully'
        ]);
    }
}
