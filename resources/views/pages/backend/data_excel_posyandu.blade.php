<?php
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=namafile.xls");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
?>
<style type="text/css">
	table td{
		padding: 3px;
		text-align: center;
		border: 1px;
	}
</style>
<table border="1">
	<tr>
		<td rowspan="3">No</td>
		<td rowspan="3">Kec</td>
		<td rowspan="3">Jml Ds & Kel</td>
		<td rowspan="3">Jml Pos</td> 
		<td colspan="4">STRATA Posyandu</td>
		<td>%</td> 
		<td colspan="2">Bangunan</td> 
		<td colspan="2">kader</td> 
		<td>%</td>  
		<td rowspan="3">S</td>
		<td rowspan="3">K</td>
		<td rowspan="3">D</td>
		<td rowspan="3">N</td>  
		<td>D/S</td>
		<td>N/D</td> 
		<td rowspan="3">Vit-A</td>
		<td colspan="10">KEGIATAN UTAMA</td>
		<td colspan="7">PROGRAM PENGEMBANGAN/INTEGRASI</td>
		<td >Dana Sehat</td> 
		

	</tr>
	<tr>
		<td rowspan="2">Pra</td>
		<td rowspan="2">Mad</td>
		<td rowspan="2">Pur</td>
		<td rowspan="2">Man</td>
		<td rowspan="2">Man</td> 
		<td rowspan="2">Jml</td>  
		<td rowspan="2">%</td>  
		<td rowspan="2">Jml</td>
		<td rowspan="2">Ter latih</td>
		<td rowspan="2">Ter latih</td>  
		<td rowspan="2">%</td>
		<td rowspan="2">%</td>
		<td rowspan="2">KB-Aktif</td> 
		<td colspan="2">KIA</td>
		<td colspan="5">Imunisasi</td> 
		<td rowspan="2">Gizi</td> 
		<td rowspan="2">Diare</td> 
		<td rowspan="2">PAUD</td> 
		<td rowspan="2">BKB</td> 
		<td rowspan="2">BKR</td> 
		<td rowspan="2">BKL</td> 
		<td rowspan="2">UP2K</td> 
		<td rowspan="2">Angka Stunting</td>
		<td rowspan="2">Inklusi</td>  
		<td rowspan="2">%</td>  


	</tr>
	<tr>
		<td>K4</td>
		<td>Fe3</td>
		<td>Campak</td>
		<td>BCG</td>
		<td>DPT</td>
		<td>HBO</td>
		<td>Polio</td> 

	</tr>

	@php
	$i=1;
	@endphp
	@foreach($data_excel as $key)
	<tr>
		<td>{{@$i++}}</td>

		<td>{{@$key->name}}</td>
		<td>{{@$key->jumlah_desa}}</td>
		<td>{{@$key->jumlah_posyandu}}</td>
		<td>{{@$key->strata['pra']}}</td>
		<td>{{@$key->strata['mad']}}</td>
		<td>{{@$key->strata['pur']}}</td>
		<td>{{@$key->strata['man']}}</td>
		<td>{{@$key->strata['man_persen']}}%</td>
		<td>{{@$key->bangunan['jml_bangunan']}}</td>
		<td>{{@$key->bangunan['jml_bgn_persen']}}%</td>
		<td>{{@$key->kader['jumlah_kader']}}</td>
		<td>{{@$key->kader['jumlah_kader_terlatih']}}</td> 
		<td>{{@$key->kader['jumlah_kader_terlatih_per']}}%</td> 
		
		<td>{{@$key->skdn['s']}}</td>
		<td>{{@$key->skdn['k']}}</td>
		<td>{{@$key->skdn['d']}}</td>
		<td>{{@$key->skdn['n']}}</td>
		<td>{{@$key->skdn['d_s']}}%</td>
		<td>{{@$key->skdn['n_d']}}%</td>
		<td>{{@$key->kegiatan_utama['vit_a']}}</td>
		<td>{{@$key->kegiatan_utama['kb_aktif']}}</td>
		<td>{{@$key->kegiatan_utama['k4']}}</td>
		<td>{{@$key->kegiatan_utama['fe3']}}</td>
		<td>{{@$key->kegiatan_utama['campak']}}</td>
		<td>{{@$key->kegiatan_utama['bcg']}}</td>
		<td>{{@$key->kegiatan_utama['dpt']}}</td>
		<td>{{@$key->kegiatan_utama['hbo']}}</td>
		<td>{{@$key->kegiatan_utama['polio']}}</td>
		<td>{{@$key->kegiatan_utama['gizi']}}</td>
		<td>{{@$key->kegiatan_utama['diare']}}</td>
		<td>{{@$key->program_pengembangan['paud']}}</td>
		<td>{{@$key->program_pengembangan['bkb']}}</td>
		<td>{{@$key->program_pengembangan['bkr']}}</td>
		<td>{{@$key->program_pengembangan['bkl']}}</td>
		<td>{{@$key->program_pengembangan['up2k']}}</td>
		<td>{{@$key->program_pengembangan['as']}}</td>
		<td>{{@$key->program_pengembangan['in']}}</td>
		<td>{{@$key->program_pengembangan['ds']}}</td>


























	</tr>
	@endforeach
	<tr>
		<tr>
		<td colspan="2">Jumlah</td> 

		<td>{{@$jumlah['jumlah_desa']}}</td>
		<td>{{@$jumlah['jml_pos']}}</td>
		<td>{{@$jumlah['jumlah_pra']}}</td>
		<td>{{@$jumlah['jumlah_mad']}}</td>
		<td>{{@$jumlah['jumlah_pur']}}</td>
		<td>{{@$jumlah['jumlah_man']}}</td>
		<td>{{@$jumlah['jml_man_persen_ttl']}}%</td>
		<td>{{@$jumlah['jml_bangunan_ttl']}}</td>
		<td>{{@$jumlah['jml_bangunan_ttl_persen']}}%</td>
		<td>{{@$jumlah['jumlah_kader_ttl']}}</td>
		<td>{{@$jumlah['jumlah_kader_terlatih_ttl']}}</td> 
		<td>{{@$jumlah['jumlah_kader_terlatih_per_ttl']}}%</td>  
		<td>{{@$jumlah['s_ttl']}}</td>
		<td>{{@$jumlah['k_ttl']}}</td>
		<td>{{@$jumlah['d_ttl']}}</td>
		<td>{{@$jumlah['n_ttl']}}</td>
		<td>{{@$jumlah['d_s_ttl']}}%</td>
		<td>{{@$jumlah['n_d_ttl']}}%</td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
 
	</tr>
	</tr>
</table>