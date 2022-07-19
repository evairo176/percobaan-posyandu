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
	@foreach($data_perkembangan as $key)
	 <tr>
                                <td>{{$i++}}</td>

                                <td>{{@$key->name}}</td>
                                <td>{{@$key->jml_desa}}</td>
                                <td>{{@$key->jml_pos}}</td>
                                <td>{{@$key->pra}}</td>
                                <td>{{@$key->mad}}</td>
                                <td>{{@$key->pur}}</td>
                                <td>{{@$key->man}}</td>
                                <td>{{@$key->man_per}}%</td>
                                <td>{{@$key->jml_bgn}}</td>
                                <td>{{@$key->jml_bgn_per}}%</td>
                                <td>{{@$key->jml_kader}}</td>
                                <td>{{@$key->jml_terlatih}}</td> 
                                <td>{{@$key->jml_terlatih_per}}%</td> 
                                <td>{{@$key->s}}</td>
                                <td>{{@$key->k}}</td>
                                <td>{{@$key->d}}</td>
                                <td>{{@$key->n}}</td>
                                <td>{{@$key->d_s}}%</td>
                                <td>{{@$key->n_d}}%</td>
                                <td>{{@$key->vit_a}}</td>
                                <td>{{@$key->kb_aktif}}</td>
                                <td>{{@$key->k4}}</td>
                                <td>{{@$key->fe3}}</td>
                                <td>{{@$key->campak}}</td>
                                <td>{{@$key->bcg}}</td>
                                <td>{{@$key->dpt}}</td>
                                <td>{{@$key->hbo}}</td>
                                <td>{{@$key->polio}}</td>
                                <td>{{@$key->gizi}}</td>
                                <td>{{@$key->diare}}</td>
                                <td>{{@$key->paud}}</td>
                                <td>{{@$key->bkb}}</td>
                                <td>{{@$key->bkr}}</td>
                                <td>{{@$key->bkl}}</td>
                                <td>{{@$key->up2k}}</td>
                                <td>{{@$key->as}}</td>
                                <td>{{@$key->in}}</td>
                                <td>{{@$key->ds}}</td>  
                                </tr>
	@endforeach
	<tr>
                                <td colspan="2">Jumlah</td>  
                                <td>{{@$ttl['ttl_dt_per_kel']}}</td>
                                <td>{{@$ttl['ttl_posyandu']}}</td>
                                <td>{{@$ttl['ttl_pra']}}</td>
                                <td>{{@$ttl['ttl_mad']}}</td>
                                <td>{{@$ttl['ttl_pur']}}</td>
                                <td>{{@$ttl['ttl_man']}}</td>
                                <td>{{@$ttl['ttl_man_per']}}%</td>
                                <td>{{@$ttl['ttl_jml_bgn']}}</td>
                                <td>{{@$ttl['ttl_jml_bgn_per']}}%</td>
                                <td>{{@$ttl['ttl_jml_kader']}}</td>
                                <td>{{@$ttl['ttl_jml_terlatih']}}</td>
                                <td>{{@$ttl['jml_terlatih_per']}}%</td> 
                                <td>{{@$ttl['ttl_s']}}</td> 
                                <td>{{@$ttl['ttl_k']}}</td>
                                <td>{{@$ttl['ttl_d']}}</td>
                                <td>{{@$ttl['ttl_n']}}</td>
                                <td>{{@$ttl['ttl_d_s_pr']}}%</td>
                                <td>{{@$ttl['ttl_n_d_pr']}}%</td>
                                <td>{{@$ttl['ttl_vit_a']}}</td>
                                <td>{{@$ttl['ttl_kb_aktif']}}</td>
                                <td>{{@$ttl['ttl_k4']}}</td>
                                <td>{{@$ttl['ttl_fe3']}}</td>
                                <td>{{@$ttl['ttl_campak']}}</td>
                                <td>{{@$ttl['ttl_bcg']}}</td>
                                <td>{{@$ttl['ttl_dpt']}}</td>
                                <td>{{@$ttl['ttl_hbo']}}</td>
                                <td>{{@$ttl['ttl_polio']}}</td>
                                <td>{{@$ttl['ttl_gizi']}}</td>
                                <td>{{@$ttl['ttl_diare']}}</td>
                                <td>{{@$ttl['ttl_paud']}}</td>
                                <td>{{@$ttl['ttl_bkb']}}</td>
                                <td>{{@$ttl['ttl_bkr']}}</td>
                                <td>{{@$ttl['ttl_bkl']}}</td>
                                <td>{{@$ttl['ttl_up2k']}}</td>
                                <td>{{@$ttl['ttl_as']}}</td>
                                <td>{{@$ttl['ttl_in']}}</td>
                                <td>{{@$ttl['ttl_ds']}}</td>
                                </tr>
</table>