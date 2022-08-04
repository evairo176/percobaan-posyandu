@extends('layouts.backend') 
@section('title','Rekap Perkembangan')
 
@section('content')
<style type="text/css">
    .table thead th {
  vertical-align: bottom;
  border-bottom: none;
  border:1px solid;
}
.table > tbody > tr > td {
    vertical-align: middle;
    color: #515365;
    font-size: 13px;
    letter-spacing: 1px;
    border: 1px solid #4361f1;
}
</style>
<div class="col-lg-12">
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <div class="betwen" >
                        <h4>Detail Perkembangan</h4> 
                         
                    </div>
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area">
            <div class="row"> 
                <div class="col-md-12"> 
                    <div class="table-responsive">
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    
                                        <form>
                                            @php
                                            $tahun=DB::table('tb_perkembangan')->select('tahun_rekap')->groupBy('tahun_rekap')->orderBy('tahun_rekap','DESC')->get();
                                            @endphp
                                            <div class="input-group">
                                                <select name="tahun" class="form-control"> 
                                                    @foreach($tahun as  $tky)
                                                   @php
                                                   $select_=$tky->tahun_rekap==@app('request')->input('tahun')?'selected="selected"':'';
                                                   @endphp

                                                    <option value="{{$tky->tahun_rekap}}" {!!$select_!!}>{{$tky->tahun_rekap}}</option>
                                                    @endforeach
                                                </select>
                                                <div class="input-group-append">
                                                    
                                                <button type="submit" class="btn btn-success btn-sm">cari</button>
                                                    <a type="button" class="btn btn-danger btn-sm" id="Export" >
                                                    Export <i class="fas fa-print"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </form>
                                        
                                </div>
                            </div>
                           <table class="table table-t text-left">
                                                <thead>
                                                    <tr>
                                <th rowspan="3">No</th>
                                <th rowspan="3">Kec</th>
                                <th rowspan="3">Jml Ds & Kel</th>
                                <th rowspan="3">Jml Pos</th> 
                                <th colspan="4">STRATA Posyandu</th>
                                <th>%</th> 
                                <th colspan="2">Bangunan</th> 
                                <th colspan="2">kader</th> 
                                <th>%</th>  
                                <th rowspan="3">S</th>
                                <th rowspan="3">K</th>
                                <th rowspan="3">D</th>
                                <th rowspan="3">N</th>  
                                <th>D/S</th>
                                <th>N/D</th> 
                                <th rowspan="3">Vit-A</th>
                                <th colspan="10">KEGIATAN UTAMA</th>
                                <th colspan="7">PROGRAM PENGEMBANGAN/INTEGRASI</th>
                                <th >Dana Sehat</th> 
                                

                            </tr>
                            <tr>
                                <th rowspan="2">Pra</th>
                                <th rowspan="2">Mad</th>
                                <th rowspan="2">Pur</th>
                                <th rowspan="2">Man</th>
                                <th rowspan="2">Man</th> 
                                <th rowspan="2">Jml</th>  
                                <th rowspan="2">%</th>  
                                <th rowspan="2">Jml</th>
                                <th rowspan="2">Ter latih</th>
                                <th rowspan="2">Ter latih</th>  
                                <th rowspan="2">%</th>
                                <th rowspan="2">%</th>
                                <th rowspan="2">KB-Aktif</th> 
                                <th colspan="2">KIA</th>
                                <th colspan="5">Imunisasi</th> 
                                <th rowspan="2">Gizi</th> 
                                <th rowspan="2">Diare</th> 
                                <th rowspan="2">PAUD</th> 
                                <th rowspan="2">BKB</th> 
                                <th rowspan="2">BKR</th> 
                                <th rowspan="2">BKL</th> 
                                <th rowspan="2">UP2K</th> 
                                <th rowspan="2">Angka Stunting</th>
                                <th rowspan="2">Inklusi</th>  
                                <th rowspan="2">%</th>  


                            </tr>
                            <tr>
                                <th>K4</th>
                                <th>Fe3</th>
                                <th>Campak</th>
                                <th>BCG</th>
                                <th>DPT</th>
                                <th>HBO</th>
                                <th>Polio</th> 

                            </tr>
                                                </thead> 
                                                <tbody id="lsidt"></tbody> 
                                             </table>    
                    </div>
                </div>
            </div>
        
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function()
    { 
        function_name();
        function function_name() 
        {
          $('#thead').html('<tr><th  class="text-center" colspan="5">Loading...<th></tr>');
               // var url_=window.url_==undefined?'{{url('data-detail-perkembangan')}}':window.url_;
                const fromh           = new FormData();    
                var cari='';
                @if(@app('request')->input('tahun'))
                cari='?tahun={{@app('request')->input('tahun')}}'; 
                @endif
              
                     fetch("{{url('data-detail-perkembangan')}}"+cari).then(res => res.json()).then(data => {
                    var lk_=``;
                    var no =1;
                        for(let lk of data.data_perkembangan)
                        {
                                lk_+=`<tr>
                                <td>`+no+`</td>

                                <td>`+lk.name+`</td>
                                <td>`+lk.jml_desa+`</td>
                                <td>`+lk.jml_pos+`</td>
                                <td>`+lk.pra+`</td>
                                <td>`+lk.mad+`</td>
                                <td>`+lk.pur+`</td>
                                <td>`+lk.man+`</td>
                                <td>`+lk.man_per+`%</td>
                                <td>`+lk.jml_bgn+`</td>
                                <td>`+lk.jml_bgn_per+`%</td>
                                <td>`+lk.jml_kader+`</td>
                                <td>`+lk.jml_terlatih+`</td> 
                                <td>`+lk.jml_terlatih_per+`%</td> 
                                <td>`+lk.s+`</td>
                                <td>`+lk.k+`</td>
                                <td>`+lk.d+`</td>
                                <td>`+lk.n+`</td>
                                <td>`+lk.d_s+`%</td>
                                <td>`+lk.n_d+`%</td>
                                <td>`+lk.vit_a+`</td>
                                <td>`+lk.kb_aktif+`</td>
                                <td>`+lk.k4+`</td>
                                <td>`+lk.fe3+`</td>
                                <td>`+lk.campak+`</td>
                                <td>`+lk.bcg+`</td>
                                <td>`+lk.dpt+`</td>
                                <td>`+lk.hbo+`</td>
                                <td>`+lk.polio+`</td>
                                <td>`+lk.gizi+`</td>
                                <td>`+lk.diare+`</td>
                                <td>`+lk.paud+`</td>
                                <td>`+lk.bkb+`</td>
                                <td>`+lk.bkr+`</td>
                                <td>`+lk.bkl+`</td>
                                <td>`+lk.up2k+`</td>
                                <td>`+lk.as+`</td>
                                <td>`+lk.in+`</td>
                                <td>`+lk.ds+`</td>  
                                </tr>`;
                                no++;
                    } 


                    lk_+=`<tr>
                                <td colspan="2">Jumlah</td>  
                                <td>`+data.ttl.ttl_dt_per_kel+`</td>
                                <td>`+data.ttl.ttl_posyandu+`</td>
                                <td>`+data.ttl.ttl_pra+`</td>
                                <td>`+data.ttl.ttl_mad+`</td>
                                <td>`+data.ttl.ttl_pur+`</td>
                                <td>`+data.ttl.ttl_man+`</td>
                                <td>`+data.ttl.ttl_man_per+`%</td>
                                <td>`+data.ttl.ttl_jml_bgn+`</td>
                                <td>`+data.ttl.ttl_jml_bgn_per+`%</td>
                                <td>`+data.ttl.ttl_jml_kader+`</td>
                                <td>`+data.ttl.ttl_jml_terlatih+`</td>
                                <td>`+data.ttl.jml_terlatih_per+`%</td> 
                                <td>`+data.ttl.ttl_s+`</td> 
                                <td>`+data.ttl.ttl_k+`</td>
                                <td>`+data.ttl.ttl_d+`</td>
                                <td>`+data.ttl.ttl_n+`</td>
                                <td>`+data.ttl.ttl_d_s_pr+`%</td>
                                <td>`+data.ttl.ttl_n_d_pr+`%</td>
                                <td>`+data.ttl.ttl_vit_a+`</td>
                                <td>`+data.ttl.ttl_kb_aktif+`</td>
                                <td>`+data.ttl.ttl_k4+`</td>
                                <td>`+data.ttl.ttl_fe3+`</td>
                                <td>`+data.ttl.ttl_campak+`</td>
                                <td>`+data.ttl.ttl_bcg+`</td>
                                <td>`+data.ttl.ttl_dpt+`</td>
                                <td>`+data.ttl.ttl_hbo+`</td>
                                <td>`+data.ttl.ttl_polio+`</td>
                                <td>`+data.ttl.ttl_gizi+`</td>
                                <td>`+data.ttl.ttl_diare+`</td>
                                <td>`+data.ttl.ttl_paud+`</td>
                                <td>`+data.ttl.ttl_bkb+`</td>
                                <td>`+data.ttl.ttl_bkr+`</td>
                                <td>`+data.ttl.ttl_bkl+`</td>
                                <td>`+data.ttl.ttl_up2k+`</td>
                                <td>`+data.ttl.ttl_as+`</td>
                                <td>`+data.ttl.ttl_in+`</td>
                                <td>`+data.ttl.ttl_ds+`</td>
                                </tr>`;
                                $('#lsidt').html(lk_);

 
                });
        }
        $('body').delegate('#Export','click',function(e)
        {   
            e.preventDefault();
            var cari='';
              @if(@app('request')->input('tahun'))
                cari='&tahun={{@app('request')->input('tahun')}}'; 
                @endif
            window.open('{{url('data-detail-perkembangan')}}?lo=ex'+cari,'blank');

        });
        
    });
</script>
@endsection 