<?php

namespace App\Exports;

// use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;

class UserExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        return view('pages.backend.dpmd.user-export', [
            'user' => DB::table('users')
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
                ->whereIn('users.role', ['petugas', 'petugas_kecamatan'])
                ->orderBy('districts.name', 'asc')
                ->get(),
        ]);
    }
}
