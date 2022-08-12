<?php

namespace App\Http\Controllers;

use App\Exports\UserExport;
use App\Models\District;
use App\Models\Posyandu;
use App\Models\User;
use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class DataUserController extends Controller
{
    public function index()
    {

        $posyandu =  DB::table('tb_rekap_posyandu')
            ->leftJoin('districts', 'tb_rekap_posyandu.kecamatan_id', '=', 'districts.id')
            ->leftJoin('villages', 'tb_rekap_posyandu.kelurahan_id', '=', 'villages.id')
            ->select(
                'tb_rekap_posyandu.*',
                'districts.*',
                'villages.*',
                'tb_rekap_posyandu.id as id_posyandu',
                'districts.name as kecamatan',
                'villages.name as kelurahan',
            )
            ->get();
        // $editPosyandu =  DB::table('tb_rekap_posyandu')
        //     ->leftJoin('districts', 'tb_rekap_posyandu.kecamatan_id', '=', 'districts.id')
        //     ->leftJoin('villages', 'tb_rekap_posyandu.kelurahan_id', '=', 'villages.id')
        //     ->select(
        //         'tb_rekap_posyandu.*',
        //         'districts.*',
        //         'villages.*',
        //         'tb_rekap_posyandu.id as id_posyandu',
        //         'districts.name as kecamatan',
        //         'villages.name as kelurahan',
        //     )
        //     ->get();
        // // dd($posyandu);

        $districts = District::where('regency_id', 3212)->get();
        $data = [
            'menu' => 'table',
            'submenu' => 'user',
            'pos' => $posyandu,
            'kecamatan' => $districts,
            // 'epos' => $editPosyandu,
        ];
        return view('pages.backend.user', $data);
    }
    public function dataPosyandu()
    {
        $posyandu =  DB::table('tb_rekap_posyandu')
            ->leftJoin('districts', 'tb_rekap_posyandu.kecamatan_id', '=', 'districts.id')
            ->leftJoin('villages', 'tb_rekap_posyandu.kelurahan_id', '=', 'villages.id')
            ->select(
                'tb_rekap_posyandu.*',
                'districts.*',
                'villages.*',
                'tb_rekap_posyandu.id as id_posyandu',
                'districts.name as kecamatan',
                'villages.name as kelurahan',
            )
            ->where('user_id', null)
            ->get();

        // dd($posyandu);
        return $posyandu;
    }
    public function store(Request $request)
    {
        // dd($request->all());
        if ($request->user_id) {
            $validator  = Validator::make(request()->all(), [
                'email' => 'unique:users,email,' . $request->user_id,
                // 'picture' => 'required',
            ]);

            if ($validator->fails()) {
                // dd($validator->getMessageBag());
                return response()->json([
                    'status' => 400,
                    'messages' => $validator->getMessageBag()
                ]);
            } else {
                $user = User::find($request->user_id);
                if ($request->hasFile('picture')) {
                    $file = $request->file('picture');
                    $fileName = $request->name . '-' . time() . '.' . $file->getClientOriginalExtension();
                    $file->storeAs('public/picture', $fileName);
                    if ($request->user_picture) {
                        Storage::delete('public/picture/' . $request->user_picture);
                    }
                } else {
                    $fileName = $user->picture;
                }
                // dd($request->all());
                if ($request->password) {
                    $pw = hash::make($request->password);
                } else {
                    $pw = $user->password;
                }
                $userData = [
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => $pw,
                    'role' => $request->role,
                    'picture' => $fileName,
                    'kecamatan_id' => $request->kecamatan_id,
                    'kelurahan_id' => $request->kelurahan_id,
                    'posyandu_id' => $request->posyandu_id ? $request->posyandu_id : null,
                ];

                $user->update($userData);
                return response()->json([
                    'status' => 200,
                    'messages' => 'Updated Successfully'
                ]);
            }
        } else {

            // dd($request->posyandu_id);
            $validator  = Validator::make(request()->all(), [
                'name' => 'required|max:50',
                'email' => 'required|email|unique:users|max:100',
                'password' => 'required|min:6|max:50',
                'cpassword' => 'required|min:6|same:password',
                'role' => 'required',
                // 'posyandu_id' => 'required',
                'picture' => 'required|mimes:jpg,bmp,png,jpeg,svg',
            ]);

            if ($validator->fails()) {
                // dd($validator->getMessageBag());
                return response()->json([
                    'status' => 400,
                    'messages' => $validator->getMessageBag()
                ]);
            } else {

                // dd($request->all());
                $file = $request->file('picture');
                $fileName = $request->name . '-' . time() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/picture', $fileName);

                // dd($request->kecamatan_id);
                $userData = [
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => hash::make($request->password),
                    'role' => $request->role,
                    'picture' => $fileName,
                    'kecamatan_id' => $request->kecamatan_id,
                    'kelurahan_id' => $request->kelurahan_id,
                    'posyandu_id' => ($request->posyandu_id) ? $request->posyandu_id : null,
                ];

                $user = User::create($userData);
                if ($request->posyandu_id) {
                    $pos = Posyandu::where('id', request()->posyandu_id)->first();
                    $pos->user_id = $user->id;
                    $pos->update();
                }
                return response()->json([
                    'status' => 200,
                    'messages' => 'Added Successfully'
                ]);
            }
        }
    }
    public function fetchAll(Request $request)
    {
        if ($request->ajax()) {
            $data =     DB::table('users')
                ->leftJoin('districts', 'users.kecamatan_id', '=', 'districts.id')
                ->leftJoin('villages', 'users.kelurahan_id', '=', 'villages.id')
                ->select(
                    'users.*',
                    'districts.*',
                    'villages.*',
                    'users.id as id_user',
                    'users.name as name_user',
                    'districts.name as kecamatan',
                    'villages.name as kelurahan',
                )
                ->orderBy('users.updated_at', 'desc')
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('picture', function ($row) {
                    $url = ($row->picture) ? asset('storage/picture/' . $row->picture) : 'boy.png';
                    return '<img src="' . $url . '" border="0" width="40" class="img-rounded" align="center" />';
                })
                // ->addColumn('created_at', function ($row) {
                //     $date = date('d-m-Y', strtotime($row->created_at));
                //     return $date;
                // })
                ->addColumn('action', function ($row) {
                    $actionBtn = '       <td class="text-center">
                    <ul class="table-controls">
                    <li><a href="javascript:void(0);" id="' . $row->id_user . '" class="detailIcon" data-toggle="tooltip" data-placement="top" title="" data-original-title="Settings"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings text-primary"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg></a> </li>
                    <li><a href="javascript:void(0);" id="' . $row->id_user . '" class="editIcon" data-bs-toggle="modal" data-bs-target="#editdataloyeeModal" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 text-success"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a></li>
                    <li><a href="javascript:void(0);" id="' . $row->id_user . '" class="deleteIcon" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 text-danger"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></a></li>                                         
                     </ul>';
                    return $actionBtn;
                })
                ->rawColumns(['picture', 'action'])
                ->make(true);
        }
    }
    public function edit(Request $request)
    {
        $id = $request->id;
        // dd($id);
        $user = User::find($id);
        // dd($user);
        return response()->json($user);
    }

    // handle delete an dataloyee ajax request
    public function delete(Request $request)
    {
        $id = $request->id;
        $user = User::find($id);
        if ($user->picture) {

            Storage::delete('public/picture/' . $user->picture);
            // dd('ada');
        }
        $user->delete();
        $posyandu = Posyandu::find($user->posyandu_id);
        // dd($posyandu);
        $posyandu->user_id = null;
        $posyandu->update();
        return Response()->json([
            'status' => 200,
            'messages' => 'Deleted Successfully'
        ]);
    }
    public function detail(Request $request)
    {
        $id = $request->id;
        // dd($id);
        $user = DB::table('users')
            ->leftJoin('districts', 'users.kecamatan_id', '=', 'districts.id')
            ->leftJoin('villages', 'users.kelurahan_id', '=', 'villages.id')
            ->select(
                'users.*',
                'districts.*',
                'villages.*',
                'users.id as id_user',
                'users.name as name_user',
                'districts.name as kecamatan',
                'villages.name as kelurahan',
            )
            ->where('users.id', $id)
            ->first();
        // dd($data->password);
        return response()->json($user);
    }

    public function getDesa(Request $request)
    {
        $desa = Village::where("district_id", $request->kecID)->pluck('id', 'name');
        // dd($desa);
        return response()->json($desa);
    }

    public function generateUser()
    {
        $posyandu = Posyandu::where('user_id', null)->get();
        // dd($posyandu->count());

        $total = 0;
        foreach ($posyandu as  $pos) {
            $total += 1;
            $password_asli = strtolower(substr($pos->nama_posyandu, 0, 2)) . rand(10000, 99999) . $pos->id;

            $data = [
                'name' =>  $pos->nama_posyandu,
                'email' =>  'pos' . $password_asli . substr(rand(10000, 99999), 0, 2) . '@email.com',
                'password' =>  hash::make($password_asli),
                'password_asli' =>  $password_asli,
                'kelurahan_id' =>  $pos->kelurahan_id,
                'kecamatan_id' =>  $pos->kecamatan_id,
                'posyandu_id' =>  $pos->id,
            ];
            // dd($data);
            $user = User::create($data);
            $posUpdate = Posyandu::find($pos->id);
            $posUpdate->user_id = $user->id;
            $posUpdate->update();
            // dd($data);
        }

        return Response()->json([
            'status' => 200,
            'messages' => 'created Successfully User Posyandu ' . $total . ''
        ]);


        // dd(rand(10000, 99999));
    }
    public function generateUserKecamatan()
    {
        $districts = District::where('regency_id', 3212)->get();
        // dd($districts->count());

        $total = 0;
        foreach ($districts as  $dis) {
            if (User::where('kecamatan_id', $dis->id)->where('role', 'petugas_kecamatan')->count() > 0) {
                $total = 0;
            } else {

                $kelurahan = Village::where("district_id", $dis->id)->first();
                // dd($kelurahan->id);
                $total += 1;
                $password_asli = strtolower(substr($dis->name, 0, 2)) . rand(10000, 99999) . $dis->id;

                $data = [
                    'name' =>  $dis->name,
                    'email' =>  'pos' . $password_asli . substr(rand(10000, 99999), 0, 2) . '@email.com',
                    'password' =>  hash::make($password_asli),
                    'password_asli' =>  $password_asli,
                    'kelurahan_id' =>  $kelurahan->id,
                    'kecamatan_id' =>  $dis->id,
                    'role' =>  'petugas_kecamatan',
                    // 'posyandu_id' =>  $dis->id,
                ];
                // dd($data);
                $user = User::create($data);
            }
        }
        // dd($total);

        return Response()->json([
            'status' => 200,
            'messages' => 'created Successfully User Kecamatan ' . $total . ''
        ]);


        // dd(rand(10000, 99999));
    }
    public function generateUserHapus()
    {
        // dd('dad');
        $user = User::where('role', 'petugas')->get();
        $total = 0;
        foreach ($user as $us) {
            $total += 1;
            $userDelete = User::find($us->id);
            $userDelete->delete();
            $posUpdate = Posyandu::where('user_id', $us->id)->first();
            $posUpdate->user_id = null;
            $posUpdate->update();
        }
        return Response()->json([
            'status' => 200,
            'messages' => 'Deleted Successfully ' . $total . ''
        ]);
        // dd($user);
    }

    public function generateUserKecamatanHapus()
    {
        // dd('dad');
        $user = User::where('role', 'petugas_kecamatan')->get();
        $total = 0;
        foreach ($user as $us) {
            $total += 1;
            $userDelete = User::find($us->id);
            $userDelete->delete();
        }
        return Response()->json([
            'status' => 200,
            'messages' => 'Deleted Successfully ' . $total . ''
        ]);
        // dd($user);
    }
    public function cetakUser()
    {
        return Excel::download(new UserExport, 'user.xlsx');
    }
}
