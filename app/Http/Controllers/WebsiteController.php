<?php

namespace App\Http\Controllers;

use App\Models\Website;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class WebsiteController extends Controller
{
    public function index()
    {
        $data = [
            'menu' => 'master',
            'submenu' => 'pengaturan website',
            'websiteInfo' => DB::table('tb_website')->where('id', 1)->first(),
        ];
        return view('pages.backend.website', $data);
    }

    public function websiteImageUpdate(Request $request)
    {
        $validator  = Validator::make(request()->all(), [
            'picture' => 'mimes:jpg,bmp,png,jpeg,svg,webp',
        ]);

        if ($validator->fails()) {
            // dd($validator->getMessageBag());
            return response()->json([
                'status' => 400,
                'messages' => $validator->getMessageBag()
            ]);
        } else {
            $website_id = $request->website_id;
            // dd($website_id);
            $website = Website::find($website_id);
            if ($request->hasFile('picture')) {
                $file = $request->file('picture');
                $fileName = $website->judul . '-' . time() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/website', $fileName);
                if ($request->picture) {
                    // dd('hapus');
                    Storage::delete('public/website/' . $website->picture);
                }
            } else {
                $fileName = $website->picture;
            }

            $websiteData = [
                'picture' => $fileName,
            ];

            $website->update($websiteData);
            return response()->json([
                'status' => 200,
                'messages' => 'Updated Successfully'
            ]);
        }
    }
    public function websiteUpdate(Request $request)
    {
        $validator  = Validator::make(request()->all(), [
            'judul' => 'required|max:50',
            'keterangan' => 'required',
        ]);

        if ($validator->fails()) {
            // dd($validator->getMessageBag());
            return response()->json([
                'status' => 400,
                'messages' => $validator->getMessageBag()
            ]);
        } else {
            $website = Website::find($request->website_id);
            $websiteData = [
                'judul' => $request->judul,
                'keterangan' => $request->keterangan,
            ];
            // dd($websiteData);
            $website->update($websiteData);
            return response()->json([
                'status' => 200,
                'messages' => 'Updated Successfully'
            ]);
        }
    }
}
