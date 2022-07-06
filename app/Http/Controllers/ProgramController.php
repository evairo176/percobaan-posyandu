<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DataTables;

class ProgramController extends Controller
{
    public function index()
    {
        if (auth()->user()->posyandu_id) {
            $data = [
                'menu' => 'table',
                'submenu' => 'Input Rekap Program',
            ];
            // dd($data);
            return view('pages.backend.rekap-program', $data);
        } else {
            return redirect()->back();
        }
    }
    public function fetchAll(Request $request)
    {
        if (auth()->user()->posyandu_id) {
            if ($request->ajax()) {
                $data = Program::where('posyandu_id', auth()->user()->posyandu_id)->latest()->get();
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
        if ($request->program_id) {
            $validator  = Validator::make(request()->all(), [
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
                $program = Program::find($request->program_id);
                $programData = [
                    'posyandu_id' => auth()->user()->posyandu_id,
                    'paud' => $request->paud,
                    'bkb' => $request->bkb,
                    'bkr' => $request->bkr,
                    'bkl' => $request->bkl,
                    'up2k' => $request->up2k,
                    'as' => $request->as,
                    'in' => $request->in,
                    'ds' => $request->ds,
                ];
                // dd($programData);
                $program->update($programData);
                return response()->json([
                    'status' => 200,
                    'messages' => 'Updated Successfully'
                ]);
            }
        } else {
            $validator  = Validator::make(request()->all(), [
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
                $programData = [
                    'posyandu_id' => auth()->user()->posyandu_id,
                    'paud' => $request->paud,
                    'bkb' => $request->bkb,
                    'bkr' => $request->bkr,
                    'bkl' => $request->bkl,
                    'up2k' => $request->up2k,
                    'as' => $request->as,
                    'in' => $request->in,
                    'ds' => $request->ds,
                ];

                Program::create($programData);
                $user = User::find(auth()->user()->id);
                $userData = [
                    'posyandu_id' => auth()->user()->posyandu_id,
                    'status_program' => 'sudah',
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
        $user = Program::find($id);
        // dd($data->password);
        return response()->json($user);
    }
}
