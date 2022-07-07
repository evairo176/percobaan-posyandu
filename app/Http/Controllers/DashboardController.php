<?php

namespace App\Http\Controllers;

use App\Models\Posyandu;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
	public function index()
	{

		$posyandu =  DB::table('tb_rekap_posyandu')
			->leftJoin('districts', 'tb_rekap_posyandu.kecamatan_id', '=', 'districts.id')
			->leftJoin('villages', 'tb_rekap_posyandu.kelurahan_id', '=', 'villages.id')
			->leftJoin('tb_geografi', 'tb_rekap_posyandu.id', '=', 'tb_geografi.posyandu_id')
			->leftJoin('tb_demografi', 'tb_rekap_posyandu.id', '=', 'tb_demografi.posyandu_id')
			->leftJoin('tb_pembentukan', 'tb_rekap_posyandu.id', '=', 'tb_pembentukan.posyandu_id')
			->select(
				'tb_rekap_posyandu.*',
				'tb_geografi.*',
				'tb_demografi.*',
				'tb_pembentukan.*',
				'tb_rekap_posyandu.id as id_posyandu',
				'districts.*',
				'villages.*',
				'districts.name as kecamatan',
				'villages.name as kelurahan',
			)->where('tb_rekap_posyandu.id', auth()->user()->posyandu_id)
			->first();
		$totalPenduduk = DB::table('tb_rekap_posyandu')
			->leftJoin('tb_geografi', 'tb_rekap_posyandu.id', '=', 'tb_geografi.posyandu_id')
			->leftJoin('tb_demografi', 'tb_rekap_posyandu.id', '=', 'tb_demografi.posyandu_id')
			->leftJoin('tb_pembentukan', 'tb_rekap_posyandu.id', '=', 'tb_pembentukan.posyandu_id')
			->select(
				'tb_rekap_posyandu.*',
				'tb_geografi.*',
				'tb_demografi.*',
				'tb_pembentukan.*',
				'tb_rekap_posyandu.id as id_posyandu',
			)
			->select(DB::raw('SUM(jml_pdd) as jmlh'))
			->first();
		// dd($totalPenduduk);
		$totalPendudukl = DB::table('tb_rekap_posyandu')
			->leftJoin('tb_geografi', 'tb_rekap_posyandu.id', '=', 'tb_geografi.posyandu_id')
			->leftJoin('tb_demografi', 'tb_rekap_posyandu.id', '=', 'tb_demografi.posyandu_id')
			->leftJoin('tb_pembentukan', 'tb_rekap_posyandu.id', '=', 'tb_pembentukan.posyandu_id')
			->select(
				'tb_rekap_posyandu.*',
				'tb_geografi.*',
				'tb_demografi.*',
				'tb_pembentukan.*',
				'tb_rekap_posyandu.id as id_posyandu',
			)
			->select(DB::raw('SUM(jml_pdd_l) as jmlh_l'))
			// ->select(DB::raw('SUM(jml_pdd_l) as jmlh_p'))
			->first();
		$totalPendudukp = DB::table('tb_rekap_posyandu')
			->leftJoin('tb_geografi', 'tb_rekap_posyandu.id', '=', 'tb_geografi.posyandu_id')
			->leftJoin('tb_demografi', 'tb_rekap_posyandu.id', '=', 'tb_demografi.posyandu_id')
			->leftJoin('tb_pembentukan', 'tb_rekap_posyandu.id', '=', 'tb_pembentukan.posyandu_id')
			->select(
				'tb_rekap_posyandu.*',
				'tb_geografi.*',
				'tb_demografi.*',
				'tb_pembentukan.*',
				'tb_rekap_posyandu.id as id_posyandu',
			)
			->select(DB::raw('SUM(jml_pdd_p) as jmlh_p'))
			->first();
		// dd($total);
		$data = [
			'menu' => 'dashboard',
			'submenu' => 'dashboard',
			'pos' => $posyandu,
			'tp' => $totalPenduduk,
			'tpl' => $totalPendudukl,
			'tpp' => $totalPendudukp,
			// 'allPos' => $data
		];
		return view('pages.backend.dashboard', $data);
	}
}
