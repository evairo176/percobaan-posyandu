<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Geografi;
use App\Models\Posyandu;
use App\Models\Regency;
use App\Models\User;
use App\Models\Village;
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
        // dd();
        $districts = District::where('regency_id', 3212)->get();
        // dd($kec);
        $data = [
            'menu' => 'table',
            'submenu' => 'Input Rekap Posyandu',
            'kecamatan' => $districts,
        ];
        // dd($data);
        return view('pages.backend.rekap-posyandu', $data);
    }
    public function fetchAll(Request $request)
    {
        if (auth()->user()->role == 'petugas') {
            if (auth()->user()->posyandu_id) {
                if ($request->ajax()) {
                    $data = DB::table('tb_rekap_posyandu')
                        ->leftJoin('districts', 'tb_rekap_posyandu.kecamatan_id', '=', 'districts.id')
                        ->leftJoin('villages', 'tb_rekap_posyandu.kelurahan_id', '=', 'villages.id')
                        ->select(
                            'tb_rekap_posyandu.*',
                            'districts.*',
                            'villages.*',
                            'tb_rekap_posyandu.id as id_posyandu',
                            'districts.name as kec',
                            'villages.name as kel',
                        )
                        ->get();
                    return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('name_petugas', function ($row) {
                            $name_petugas = ($row->name_petugas) ? $row->name_petugas : 'petugas tidak ada';
                            return $name_petugas;
                        })
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
                $data = DB::table('tb_rekap_posyandu')
                    ->leftJoin('districts', 'tb_rekap_posyandu.kecamatan_id', '=', 'districts.id')
                    ->leftJoin('villages', 'tb_rekap_posyandu.kelurahan_id', '=', 'villages.id')
                    ->leftJoin('users', 'tb_rekap_posyandu.user_id', '=', 'users.id')
                    ->select(
                        'tb_rekap_posyandu.*',
                        'districts.*',
                        'villages.*',
                        'tb_rekap_posyandu.id as id_posyandu',
                        'districts.name as kec',
                        'villages.name as kel',
                        'users.name as name_petugas',
                    )
                    ->latest()
                    ->get();
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('name_petugas', function ($row) {
                        $name_petugas = ($row->name_petugas) ? $row->name_petugas : 'petugas tidak ada';
                        return $name_petugas;
                    })
                    ->addColumn('created_at', function ($row) {
                        $date = date('d-m-Y', strtotime($row->created_at));
                        return $date;
                    })
                    ->addColumn('action', function ($row) {
                        $actionBtn = '       <td class="text-center">
                    <ul class="table-controls">
                    <li><a href="posyandu/cetak-pdf/' . $row->id_posyandu . '" id="" class="detailIcon" data-toggle="tooltip" data-placement="top" title="" data-original-title="Settings"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg></a> </li>
                    <li><a href="javascript:void(0);" id="' . $row->id_posyandu . '" class="editIcon" data-bs-toggle="modal" data-bs-target="#editdataloyeeModal" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 text-success"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a></li> 
                    <li><a href="javascript:void(0);" id="' . $row->id_posyandu . '" class="deleteIcon" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 text-danger"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></a></li>                                          
                    </ul>';
                        return $actionBtn;
                    })
                    ->rawColumns(['picture', 'action', 'name_petugas'])
                    ->make(true);
                // <li><a href="javascript:void(0);" id="' . $row->id . '" class="deleteIcon" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 text-danger"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></a></li>                                                                              
                // <li><a href="posyandu/detail/' . $row->id . '" id="" class="detailIcon btn btn-secondary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Settings"><i class="fas fa-print"></i> Print</a> </li>
            }
        }
    }

    public function store(Request $request)
    {
        // dd($request->all());
        if ($request->posyandu_id) {
            $validator  = Validator::make(request()->all(), [
                'nama_posyandu' => 'required',
                'blok' => 'required',
                'rt' => 'required|numeric',
                'rw' => 'required|numeric',
                'kelurahan_id' => 'required',
                'kecamatan_id' => 'required',
                // 'kabupaten' => 'required',
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
                    'kelurahan_id' => $request->kelurahan_id,
                    'kecamatan_id' => $request->kecamatan_id,
                    // 'kabupaten' => $request->kabupaten,
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
                'kelurahan_id' => 'required',
                'kecamatan_id' => 'required',
                // 'kabupaten' => 'required',
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
                    'kelurahan_id' => $request->kelurahan_id,
                    'kecamatan_id' => $request->kecamatan_id,
                    // 'kabupaten' => $request->kabupaten,
                ];
                // dd($posyanduData);

                $pos = Posyandu::create($posyanduData);
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
                    'districts.name as kec',
                    'villages.name as kel',
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
                ->leftJoin('districts', 'tb_rekap_posyandu.kecamatan_id', '=', 'districts.id')
                ->leftJoin('villages', 'tb_rekap_posyandu.kelurahan_id', '=', 'villages.id')
                ->leftJoin('tb_geografi', 'tb_rekap_posyandu.id', '=', 'tb_geografi.posyandu_id')
                ->leftJoin('tb_demografi', 'tb_rekap_posyandu.id', '=', 'tb_demografi.posyandu_id')
                ->leftJoin('tb_pembentukan', 'tb_rekap_posyandu.id', '=', 'tb_pembentukan.posyandu_id')
                ->leftJoin('tb_kepengurusan', 'tb_rekap_posyandu.id', '=', 'tb_kepengurusan.posyandu_id')
                ->leftJoin('tb_sarana', 'tb_rekap_posyandu.id', '=', 'tb_sarana.posyandu_id')
                ->select(
                    'tb_rekap_posyandu.*',
                    'districts.*',
                    'villages.*',
                    'tb_geografi.*',
                    'tb_demografi.*',
                    'tb_pembentukan.*',
                    'tb_kepengurusan.*',
                    'tb_sarana.*',
                    'tb_rekap_posyandu.id as id_posyandu',
                    'districts.name as kec',
                    'villages.name as kel',
                )
                ->first(),
        ];
        // dd($data);
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
                ->leftJoin('tb_sarana', 'tb_rekap_posyandu.id', '=', 'tb_sarana.posyandu_id')
                ->select(
                    'tb_rekap_posyandu.*',
                    'tb_geografi.*',
                    'tb_demografi.*',
                    'tb_pembentukan.*',
                    'tb_kepengurusan.*',
                    'tb_sarana.*',
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
                ->leftJoin('districts', 'tb_rekap_posyandu.kecamatan_id', '=', 'districts.id')
                ->leftJoin('villages', 'tb_rekap_posyandu.kelurahan_id', '=', 'villages.id')
                ->leftJoin('tb_geografi', 'tb_rekap_posyandu.id', '=', 'tb_geografi.posyandu_id')
                ->leftJoin('tb_demografi', 'tb_rekap_posyandu.id', '=', 'tb_demografi.posyandu_id')
                ->leftJoin('tb_pembentukan', 'tb_rekap_posyandu.id', '=', 'tb_pembentukan.posyandu_id')
                ->leftJoin('tb_kepengurusan', 'tb_rekap_posyandu.id', '=', 'tb_kepengurusan.posyandu_id')
                ->leftJoin('tb_sarana', 'tb_rekap_posyandu.id', '=', 'tb_sarana.posyandu_id')
                ->select(
                    'tb_rekap_posyandu.*',
                    'districts.*',
                    'villages.*',
                    'tb_geografi.*',
                    'tb_demografi.*',
                    'tb_pembentukan.*',
                    'tb_kepengurusan.*',
                    'tb_sarana.*',
                    'tb_rekap_posyandu.id as id_posyandu',
                    'districts.name as kec',
                    'villages.name as kel',
                )
                ->get(),
        ];
        // dd($data);
        $pdf = PDF::loadView('pages.backend.cetakPdfAll', $data);
        return $pdf->download('data-' . 'semua-data-posyandu' . '.pdf');
        // return view('pages.backend.cetakPdfAll', $data);
    }


    public function getDesa(Request $request)
    {
        $desa = Village::where("district_id", $request->kecID)->pluck('id', 'name');
        // dd($desa);
        return response()->json($desa);
    }
    public function Exportexcel(Request $request)
    {
        $data_excel                     = DB::table('districts')->where('regency_id', 3212)->get();
        $o                              = 0;
        $jumlah_desa    = 0;
        $jml_pos                        = 0;
        $jumlah_pra                     = 0;
        $jumlah_mad                     = 0;
        $jumlah_pur                     = 0;
        $jumlah_man                     = 0;
        $jml_man_persen_ttl             = 0;
        $jml_bangunan_ttl               = 0;
        $jml_bangunan_ttl_persen        = 0;
        $jumlah_kader_ttl               = 0;
        $jumlah_kader_terlatih_ttl      = 0;
        $jumlah_kader_terlatih_per_ttl  = 0;
        $s_ttl                          = 0;
        $k_ttl                          = 0;
        $d_ttl                          = 0;
        $n_ttl                          = 0;
        $d_s_ttl                        = 0;
        $n_d_ttl                        = 0;
        foreach ($data_excel as $key) {
            //  echo $key->id.'<br>';
            $data = DB::table('tb_rekap_posyandu');
            $data->select(
                'tb_rekap_posyandu.id',
                'tb_strata.pra',
                'tb_strata.mad',
                'tb_strata.pur',
                'tb_strata.man',
                'tb_strata.jml_bgn_s',
                'tb_sarana.id as id_bngn',
                'tb_skdn.s',
                'tb_skdn.k',
                'tb_skdn.d',
                'tb_skdn.n',
                'tb_kegiatan_utama.vit_a',
                'tb_kegiatan_utama.kb_aktif',
                'tb_kegiatan_utama.k4',
                'tb_kegiatan_utama.fe3',
                'tb_kegiatan_utama.campak',
                'tb_kegiatan_utama.bcg',
                'tb_kegiatan_utama.dpt',
                'tb_kegiatan_utama.hbo',
                'tb_kegiatan_utama.polio',
                'tb_kegiatan_utama.gizi',
                'tb_kegiatan_utama.diare',
                // 'tb_perkembangan.paud',
                // 'tb_perkembangan.bkb',
                // 'tb_perkembangan.bkr',
                // 'tb_perkembangan.bkl',
                // 'tb_perkembangan.up2k',
                // 'tb_perkembangan.as',
                // 'tb_perkembangan.in',
                // 'tb_perkembangan.ds',
            );
            $data->leftJoin('tb_strata', 'tb_strata.posyandu_id', '=', 'tb_rekap_posyandu.id');
            $data->leftJoin('tb_sarana', 'tb_sarana.posyandu_id', '=', 'tb_rekap_posyandu.id');
            $data->leftJoin('tb_skdn', 'tb_skdn.posyandu_id', '=', 'tb_rekap_posyandu.id');
            $data->leftJoin('tb_kegiatan_utama', 'tb_kegiatan_utama.posyandu_id', '=', 'tb_rekap_posyandu.id');
            //$data->leftJoin('tb_perkembangan','tb_perkembangan.posyandu_id','=','tb_rekap_posyandu.id');
            $data->where('tb_rekap_posyandu.kecamatan_id', @$key->id);
            if ($request->get('date')) {
                $data->whereDate('tb_rekap_posyandu.updated_at', $request->get('date'));
            }
            $posyandu_1                   = $data->get();
            $data_excel[$o]->jumlah_desa = DB::table('villages')->where('district_id', @$key->id)->count();
            // echo '<pre>';
            // print_r($posyandu);
            // echo '</pre>';
            $pra                        = 0;
            $mad                        = 0;
            $pur                        = 0;
            $man                        = 0;
            $man_persen                 = 0;
            $jml_bgn_s                  = 0;
            $jml_bangunan               = 0;
            $jumlah_kader               = 0;
            $jumlah_kader_terlatih      = 0;
            $jumlah_kader_terlatih_per  = 0;
            $s                          = 0;
            $k                          = 0;
            $d                          = 0;
            $n                          = 0;
            $d_s                        = 0;
            $n_d                        = 0;
            $vit_a                      = 0;
            $kb_aktif                   = 0;
            $k4                         = 0;
            $fe3                        = 0;
            $campak                     = 0;
            $bcg                        = 0;
            $dpt                        = 0;
            $hbo                        = 0;
            $polio                      = 0;
            $gizi                       = 0;
            $diare                      = 0;
            $paud                       = 0;
            $bkb                        = 0;
            $bkr                        = 0;
            $bkl                        = 0;
            $up2k                       = 0;
            $as                         = 0;
            $in                         = 0;
            $ds                         = 0;
            $data_excel[$o]->jumlah_posyandu = count($posyandu_1);
            foreach ($posyandu_1 as $pyd) {
                //  echo @$pyd->id.'<br>';
                $pra         += @$pyd->pra;
                $mad         += @$pyd->mad;
                $pur         += @$pyd->pur;
                $man         += @$pyd->man;
                $jml_bgn_s   += @$pyd->jml_bgn_s;
                if (@$pyd->id_bngn) {
                    $jml_bangunan += 1;
                }
                $kdr = DB::table('tb_kader')->where('posyandu_id', @$pyd->id)->get();
                $jumlah_kader += count($kdr);
                foreach ($kdr as $kdrkey) {
                    if (@$kdrkey->terlatih == 'ya') {
                        $jumlah_kader_terlatih += 1;
                    }
                }
                $s              += @$pyd->s;
                $k              += @$pyd->k;
                $d              += @$pyd->d;
                $n              += @$pyd->n;
                $vit_a          += @$pyd->vit_a;
                $kb_aktif       += @$pyd->kb_aktif;
                $k4             += @$pyd->k4;
                $fe3            += @$pyd->fe3;
                $campak         += @$pyd->campak;
                $bcg            += @$pyd->bcg;
                $dpt            += @$pyd->dpt;
                $hbo            += @$pyd->hbo;
                $polio          += @$pyd->polio;
                $gizi           += @$pyd->gizi;
                $diare          += @$pyd->diare;
                $tb_perkembangan = DB::table('tb_perkembangan')->where('posyandu_id', @$pyd->id)->get();
                foreach ($tb_perkembangan as $pkmbkey) {
                    $paud           += $paud;
                    $bkb            += $bkb;
                    $bkr            += $bkr;
                    $bkl            += $bkl;
                    $up2k           += $up2k;
                    $as             += $as;
                    $in             += $in;
                    $ds             += $ds;
                }
            }

            $man_persen                 = $man != 0 ? ceil((count($posyandu_1) / $man) * 100) : 0;
            $data_excel[$o]->strata     = array(
                'pra'       => $pra,
                'mad'       => $mad,
                'pur'       => $pur,
                'man'       => $man,
                'jml_bgn_s' => $jml_bgn_s,
                'man_persen' => $man_persen
            );

            $jml_bgn_persen             = $jml_bangunan != 0 ? ceil((count($posyandu_1) / $jml_bangunan) * 100) : 0;
            $data_excel[$o]->bangunan   = array(
                'jml_bangunan' => $jml_bangunan,
                'jml_bgn_persen' => $jml_bgn_persen
            );


            $jumlah_kader_terlatih_per  = $jumlah_kader != 0 ? ceil(($jumlah_kader / $jumlah_kader_terlatih) * 100) : 0;
            $data_excel[$o]->kader      = array(
                'jumlah_kader'              => $jumlah_kader,
                'jumlah_kader_terlatih'     => $jumlah_kader_terlatih,
                'jumlah_kader_terlatih_per' => $jumlah_kader_terlatih_per
            );
            $d_s                        = $d != 0 ? ceil(($d / $s) * 100) : 0;
            $n_d                        = $n != 0 ? ceil(($n / $d) * 100) : 0;
            $data_excel[$o]->skdn       = array('s' => $s, 'k' => $k, 'd' => $d, 'n' => $n, 'd_s' => $d_s, 'n_d' => $n_d);
            $data_excel[$o]->kegiatan_utama = array(
                'vit_a' => $vit_a,
                'kb_aktif' => $kb_aktif,
                'k4' => $k4,
                'fe3' => $fe3,
                'campak' => $campak,
                'bcg' => $bcg,
                'dpt' => $dpt,
                'hbo' => $hbo,
                'polio' => $polio,
                'gizi' => $gizi,
                'diare' => $diare
            );
            $data_excel[$o]->program_pengembangan = array(
                'paud' => $paud,
                'bkb' => $bkb,
                'bkr' => $bkr,
                'bkl' => $bkl,
                'up2k' => $up2k,
                'as' => $as,
                'in' => $in,
                'ds' => $ds
            );



            $jumlah_desa                  += $data_excel[$o]->jumlah_desa;
            $o++;
            $jml_pos                      += count($posyandu_1);
            $jumlah_pra                   += $pra;
            $jumlah_mad                   += $mad;
            $jumlah_pur                   += $pur;
            $jumlah_man                   += $man;
            $jml_man_persen_ttl           += $man_persen;
            $jml_bangunan_ttl             += $jml_bangunan;
            $jml_bangunan_ttl_persen      += $jml_bgn_persen;
            $jumlah_kader_ttl             += $jumlah_kader;
            $jumlah_kader_terlatih_ttl    += $jumlah_kader_terlatih;
            $jumlah_kader_terlatih_per_ttl += $jumlah_kader_terlatih_per;
            $s_ttl += $s;
            $k_ttl += $k;
            $d_ttl += $d;
            $n_ttl += $n;
            $d_s_ttl += $d_s;
            $n_d_ttl += $n_d;
        }
        $jml_man_persen_ttl               = $jml_man_persen_ttl != 0 ? ceil(($jml_man_persen_ttl / $o) * 100) : 0;
        $jml_bangunan_ttl_persen          = $jml_bangunan_ttl_persen != 0 ? ceil(($jml_bangunan_ttl_persen / $o) * 100) : 0;
        $jumlah_kader_terlatih_per_ttl    = $jumlah_kader_terlatih_per_ttl != 0 ? ceil(($o / $jumlah_kader_terlatih_per_ttl) * 100) : 0;
        $d_s_ttl                          = $d_s_ttl != 0 ? ceil(($o / $d_s_ttl) * 100) : 0;
        $n_d_ttl                          = $n_d_ttl != 0 ? ceil(($o / $n_d_ttl) * 100) : 0;


        $jumlah = array(
            'jumlah_desa'                   => $jumlah_desa,
            'jml_pos'                       => $jml_pos,
            'jumlah_pra'                    => $jumlah_pra,
            'jumlah_mad'                    => $jumlah_mad,
            'jumlah_man'                    => $jumlah_man,
            'jumlah_pur'                    => $jumlah_pur,
            'jml_man_persen_ttl'            => $jml_man_persen_ttl,
            'jml_bangunan_ttl'              => $jml_bangunan_ttl,
            'jml_bangunan_ttl_persen'       => $jml_bangunan_ttl_persen,
            'jumlah_kader_ttl'              => $jumlah_kader_ttl,
            'jumlah_kader_terlatih_ttl'     => $jumlah_kader_terlatih_ttl,
            'jumlah_kader_terlatih_per_ttl' => $jumlah_kader_terlatih_per_ttl,
            's_ttl'                         => $s_ttl,
            'k_ttl'                         => $k_ttl,
            'd_ttl'                         => $d_ttl,
            'n_ttl'                         => $n_ttl,
            'd_s_ttl'                       => $d_s_ttl,
            'n_d_ttl'                       => $n_d_ttl,

        );
        //dd($jumlah);
        return view('pages.backend.data_excel_posyandu', compact('data_excel', 'jumlah'));
    }
}
