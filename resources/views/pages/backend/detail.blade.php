@extends('layouts.backend') 
@section('title','Kuis')
@push('add-styles')
<link href="{{asset('backend')}}/assets/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{asset('backend')}}/assets/css/forms/theme-checkbox-radio.css">
<link href="{{asset('backend')}}/assets/css/tables/table-basic.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{asset('datatable')}}/datatables.min.css" />
<script src="{{asset('backend')}}/plugins/sweetalerts/promise-polyfill.js"></script>
<link href="{{asset('backend')}}/plugins/sweetalerts/sweetalert2.min.css" rel="stylesheet" type="text/css" />
<link href="{{asset('backend')}}/plugins/sweetalerts/sweetalert.css" rel="stylesheet" type="text/css" />
<link href="{{asset('backend')}}/assets/css/components/custom-sweetalert.css" rel="stylesheet" type="text/css" />
<link href="{{asset('backend')}}/assets/css/components/custom-modal.css" rel="stylesheet" type="text/css" />
@endpush
@section('content')
<style type="text/css">
	.nav-tabs li {
  margin: 5px 0px;
}
.nav-tabs li a.active {
  background: rgb(68, 94, 222);
  color: #fff; 
} 
.nav-tabs > li > a {
  padding: 10px;
  margin: 5px 0px;
}
.input-group-btn {
  padding: 10px;
  border: 1px solid #ccc;
  background: #cccccc2e;
}
.form-control
{
	height: unset;
}
input[disabled], select[disabled], textarea[disabled], input[readonly], select[readonly], textarea[readonly] {
  cursor: not-allowed;
  background-color: #f1f2f300 !important;
  color: #333;
} 
</style>
<div class="col-lg-12">
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <div class="betwen" >
                        <h4>Kuis</h4> 
                        <a class="btn btn-success btn-sm" href="{{url('cetak-pdf',@request()->id_detail)}}">Cetak Pdf</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area">
        	<div class="row"> 
        		<div class="col-md-12"> 
			             <form id="simpanKuis" name="simpanKuis">
			             		<div class="form-group">
			             			<label>Nama Posyandu</label>
			             			<input type="text" name="nama_posyandu" disabled="disabled" class="form-control">
			             		</div>
			             		<div class="form-group row">
			             			<div class="col-md-6">
			             			<label>Blok</label>
			             			<input type="text" name="blok" disabled="disabled" class="form-control"> 
			             			</div>
			             			<div class="col-md-6">
			             			<label>RT / RW</label>
			             			<input type="text" name="rt_rw" disabled="disabled" class="form-control"> 
			             			</div>
			             		</div>
								<div class="form-group">
									<label>Kelurahan</label>
									<input type="text" name="kelurahan" disabled="disabled" class="form-control">
								</div>

								<div class="form-group">
								<label>Kecamatan</label>
								<input type="text" name="kecamatan" disabled="disabled" class="form-control">
								</div>	
								<div class="form-group">
								<label>Kabupaten</label>
								<input type="text" name="kabupaten" disabled="disabled" class="form-control">
								</div>								
								<ul class="nav nav-tabs" role="tablist"> 
								</ul>
								<div class="tab-content">
								</div> 
			             </form>
        			
        		</div>
        	</div>
		
		</div>
	</div>
</div>
@endsection 
@push('add-scripts')
<script src="{{asset('backend')}}/assets/js/scrollspyNav.js"></script>
<script type="text/javascript" src="{{asset('datatable')}}/datatables.min.js"></script>
<script src="{{asset('backend')}}/assets/js/scrollspyNav.js"></script>
<script src="{{asset('backend')}}/plugins/sweetalerts/sweetalert2.min.js"></script>
<script src="{{asset('backend')}}/plugins/sweetalerts/custom-sweetalert.js"></script>
<script>
$(document).ready(function() 
{
	// mendapatkan list data Kuis
		window.data_edit='{{@request()->id_detail}}'; 
		data_kuis();
		function data_kuis()
		{
			window.page 		=window.page==undefined?1:window.page;
			const formgetdata   = new FormData(); 
			formgetdata.append('_token','{{csrf_token()}}'); 
			if(window.data_edit!=undefined)
			{
			formgetdata.append('id_data',window.data_edit); 

			}
			fetch('{{url('kuis-detail')}}?page='+window.page, { method: 'POST',body:formgetdata}).then(res => res.json()).then(data => 
			{ 
				if(data.data_kat.data)
				{   
					var current_page=data.data_kat.current_page;
					var data_current=data.data_kat.data;
					if(window.page==1)
					{
						if(data.dat_id)
						{
							$('input[name="nama_posyandu"]').val(data.dat_id.nama_pos);
							$('input[name="blok"]').val(data.dat_id.blok);
							$('input[name="rt_rw"]').val(data.dat_id.rt_rw);
							$('input[name="kabupaten"]').val('INDRAMAYU');
							kecamatan(data.dat_id.kecamatan);
							kelurahan(data.dat_id.kecamatan,data.dat_id.kelurahan);

						}
						 
						var last_page=data.data_kat.last_page;
						tab_acordion(current_page,last_page);
					}
					page_curent(current_page,data_current);
  
				}
			}); 
		}
		// selesai fungsi data Kuis
		// membuat halaman dengan bentuk acording
function tab_acordion(current_page,last_page)
{
	var curent_page=current_page==0?1:current_page;
	var last_page=last_page;
	var ak_=``;
	var el_=``;
	for(var i=curent_page; i<=last_page;i++)
	{
		var akt_=i==1?'active':'';
		ak_+=`<li role="presentation"><a href="#acording_`+i+`" data-page="`+i+`" aria-controls="acording_`+i+`" role="tab" data-toggle="tab"  class="`+akt_+` show_tab">Halaman Kuis `+i+`</a></li>`;
		el_+=`<div role="tabpanel" class="tab-pane `+akt_+`" id="acording_`+i+`"></div>`;
	}
	$('#simpanKuis').find('.nav-tabs').html(ak_);
	$('#simpanKuis').find('.tab-content').html(el_);

}
// selesai membuat halaman dengan bentuk acording
//memanggil subkategori pas di klik tab halaman kuis
window['id_sub']=[];
function page_curent(page_,data_current)
{
	 
	window['curent_page_'+page_]=page_;
	var tb=`<table class="table">`;
	for(let tl of data_current)
	{
		tb+=`<tr><th>`+tl.nama_kategori+`</th></tr>
		<tr><td>`; 
			for(let sub of tl.sub_kategori)
			{
				tb+=`<div class="form-group row"><label class="col-md-5">`+sub.nama_subkategori+`</label><div class="col-md-7"><div class="input-group">`;
				window['id_sub'].push(sub.id);
				for(let jnform of sub.atribute)
				{
					var input_=``;
					switch(jnform.jenis_form)
					{ 
						case 'input':
						var value_=sub.jawaban[jnform.id]!=undefined?sub.jawaban[jnform.id]:'';
						input_ =`<div class="form-control" >`+value_+`</div> <span class="input-group-btn">`+jnform.nama_attribut+`</span>`;
						break ;
						case 'select':
						var value_=sub.jawaban[jnform.id]!=undefined?'value="'+sub.jawaban[jnform.id]+'"':'';
						input_ =`<div class="form-control"> `+value_+`</div> <span class="input-group-btn">`+jnform.nama_attribut+`</span>`;
						break ;
						case 'radio':
						var checked_='';
						if(sub.jawaban[jnform.id]!=undefined)
						{
							checked_=jnform.id==sub.jawaban[jnform.id]?'checked="checked"':'';
						} 
						input_ =`<div class="form-control"><input type="radio" disabled="disabled" name="jns_`+sub.id+`" value="`+jnform.id+`" `+checked_+`> `+jnform.nama_attribut+`</div>`;
						break ;
						case 'textarea':
						var value_=sub.jawaban[jnform.id]!=undefined?sub.jawaban[jnform.id]:'';
						input_ =`<span class="input-group-btn">`+jnform.nama_attribut+`</span><textarea class="form-control" name="jns_`+sub.id+`" readonly="readonly" >`+value_+`</textarea>`;
						break;
						case 'checkbox':
						var checked_='';
						if(sub.jawaban[jnform.id]!=undefined)
						{
							checked_=jnform.id==sub.jawaban[jnform.id]?'checked="checked"':'';
						} 
						input_ =`<div class="form-control"><label>`+jnform.nama_attribut+`</label> <input name="jns_`+sub.id+`[]" type="checkbox" disabled="disabled" value="`+jnform.id+`" `+checked_+` ></div>`;
						break
					}
					tb+=input_;
				}
				tb+=`</div></div></div>`;
			}
		tb+=`</td></tr>`; 
	}
	tb+=`</table>`;
	$('#acording_'+page_).html(tb);
}
//memanggil subkategori pas di klik tab halaman kuis
// menampilkan halaman berikutnya
	$('body').delegate('.show_tab','click',function(e)
	{ 
		var id_page=$(this).data('page');
		if(window['curent_page_'+id_page]==undefined)
		{
			window.page =id_page;
			data_kuis();
		} 
	});
// menampilkan halaman berikutnya
 function kecamatan(id='')
        {
                fetch(`http://www.emsifa.com/api-wilayah-indonesia/api/districts/3212.json`)
                .then(response => response.json())
                .then(districts => 
                { 
                    var option='';
                    for(let kec of districts)
                    {
                        if(kec.id==id)
                        { 
							$('input[name="kecamatan"]').val(kec.name);
                            break;
                        }
                      
                    }
                });
        }
function kelurahan(id_kec='',id='')
        {
                $('select[name="kelurahan"').removeAttr('disabled');
                fetch(`http://www.emsifa.com/api-wilayah-indonesia/api/villages/`+id_kec+`.json`)
                .then(response => response.json())
                .then(villages  => 
                { var option='';
                    for(let kel of villages)
                    {
                         if(kel.id==id)
                        { 
                             $('input[name="kelurahan"]').val(kel.name);
                            break;
                        }
                    }
 
                });
        }
  });
</script>
@endpush