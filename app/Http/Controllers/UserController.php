<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Posyandu;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login()
    {
        // if (session()->has('loggedInUser')) {
        //     return redirect('/profile');
        // }
        return view('pages.login');
    }
    public function register()
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
        $districts = District::where('regency_id', 3212)->get();
        $data = [
            'pos' => $posyandu,
            'kecamatan' => $districts,
        ];
        return view('pages.register', $data);
    }
    public function forgot()
    {
        // if (session()->has('loggedInUser')) {
        //     return redirect('/profile');
        // }
        return view('pages.forgot');
    }
    public function reset()
    {
        // if (session()->has('loggedInUser')) {
        //     return redirect('/profile');
        // }
        return view('pages.reset');
    }

    public function saveUser()
    {
        // dd(request()->all());
        $validator  = Validator::make(request()->all(), [
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users|max:100',
            'password' => 'required|min:6|max:50',
            'cpassword' => 'required|min:6|same:password',
            'posyandu_id' => 'required',
            // 'posyandu_id' => 'required',
        ]);

        if ($validator->fails()) {
            // dd($validator->getMessageBag());
            return response()->json([
                'status' => 400,
                'messages' => $validator->getMessageBag()
            ]);
        } else {
            // dd($request->kecamatan_id);

            $user = new User();
            $user->name = request()->name;
            $user->email = request()->email;
            $user->password = hash::make(request()->password);
            $user->posyandu_id = request()->posyandu_id;
            $user->kecamatan_id = request()->kecamatan_id;
            $user->kelurahan_id = request()->kelurahan_id;
            $user->save();
            if (request()->posyandu_id) {
                $pos = Posyandu::where('id', request()->posyandu_id)->first();
                $pos->user_id = $user->id;
                $pos->update();
            }

            return response()->json([
                'status' => 200,
                'messages' => 'Register Successfully'
            ]);
        }
    }
    public function loginUser(Request $request)
    {
        $validator  = Validator::make(request()->all(), [
            'email' => 'required|email|max:100',
            'password' => 'required|min:6|max:50',
        ]);

        if ($validator->fails()) {
            // dd($validator->getMessageBag());
            return response()->json([
                'status' => 400,
                'messages' => $validator->getMessageBag()
            ]);
        } else {
            $kredensil = $request->only('email', 'password');

            if (Auth::attempt($kredensil)) {
                if (Auth::user()->role == 'petugas') {
                    $request->session()->regenerate();
                    // dd(Auth::user()->role);
                    return response()->json([
                        'status' => 200,
                        'messages' => 'success'
                    ]);
                } else if (Auth::user()->role == 'super-admin') {
                    $request->session()->regenerate();
                    return response()->json([
                        'status' => 200,
                        'messages' => 'success'
                    ]);
                } else if (Auth::user()->role == 'petugas_kecamatan') {
                    $request->session()->regenerate();
                    return response()->json([
                        'status' => 200,
                        'messages' => 'success'
                    ]);
                }
            } else {
                return response()->json([
                    'status' => 401,
                    'messages' => 'User not found!'
                ]);
            }
        }
    }
    public function profile()
    {
        $data = [
            'menu' => 'master',
            'submenu' => 'profile',
            'userInfo' => DB::table('users')->where('id', auth()->user()->id)->first(),
        ];
        return view('pages.backend.profile', $data);
    }

    public function profileImageUpdate(Request $request)
    {
        $validator  = Validator::make(request()->all(), [
            'picture' => 'mimes:jpg,bmp,png,jpeg,svg',
        ]);

        if ($validator->fails()) {
            // dd($validator->getMessageBag());
            return response()->json([
                'status' => 400,
                'messages' => $validator->getMessageBag()
            ]);
        } else {
            $user_id = $request->user_id;
            // dd($user_id);
            $user = User::find($user_id);
            if ($request->hasFile('picture')) {
                $file = $request->file('picture');
                $fileName = $user->name . '-' . time() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/picture', $fileName);
                if ($request->picture) {
                    // dd('hapus');
                    Storage::delete('public/picture/' . $user->picture);
                }
            } else {
                $fileName = $user->picture;
            }

            $userData = [
                'picture' => $fileName,
            ];

            $user->update($userData);
            return response()->json([
                'status' => 200,
                'messages' => 'Updated Successfully'
            ]);
        }
    }

    public function profileUpdate(Request $request)
    {
        $validator  = Validator::make(request()->all(), [
            'name' => 'required|max:50',
            'email' => 'unique:users,email,' . $request->user_id,
            'gender' => 'required',
            'phone' => 'required|numeric',
            'dob' => 'required',
        ]);

        if ($validator->fails()) {
            // dd($validator->getMessageBag());
            return response()->json([
                'status' => 400,
                'messages' => $validator->getMessageBag()
            ]);
        } else {
            $user = User::find($request->user_id);
            $userData = [
                'name' => $request->name,
                'email' => $request->email,
                'gender' => $request->gender,
                'phone' => $request->phone,
                'dob' => $request->dob,
            ];
            // dd($userData);
            $user->update($userData);
            return response()->json([
                'status' => 200,
                'messages' => 'Updated Successfully'
            ]);
        }
    }
    public function logout()
    {
        request()->session()->flush();
        Auth::logout();
        return redirect('/login');
    }
}
