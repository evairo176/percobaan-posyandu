<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use DB;
use Auth;
use Carbon\Carbon;
class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'menu' => 'dashboard',
            'submenu' => 'dashboard',
        ];
        return view('pages.backend.dashboard', $data);
    }
    public function kuispetugas(Request $req)
    {
    	$data = [
            'menu' => 'table',
            'submenu' => 'kuis-petugas',
        ];
    	return view('pages.backend.kuis', $data);
    }
     public function getdatakuis(Request $req)
    {
    	$dat_kat=DB::table('tb_kategori')->paginate(10);
    	$i=0;
    	$dat_id=array();
    	if(@$req->input('id_data'))
    	{
    		$dat_id=DB::table('tb_data')->where('id',@$req->input('id_data'))->first();
    	}
    	foreach ($dat_kat as $key) 
    	{
    		@$dat_kat[$i]->sub_kategori=DB::table('tb_subkategori')->where('id_kategori',@$key->id)->orderBy('urutan','ASC')->get();
    		$ii=0;
    		foreach (@$dat_kat[$i]->sub_kategori as $kye_2) 
    		{
    			$id_attr 	=@unserialize(@$kye_2->nama_attribut)?@unserialize(@$kye_2->nama_attribut):array();
    			@$dat_kat[$i]->sub_kategori[$ii]->atribute=DB::table('tb_attribut')->whereIn('id',$id_attr)->get();
    		//	$dtjwb->where('id_user',Auth::user()->id);
    			@$dat_kat[$i]->sub_kategori[$ii]->jawaban=array();
    			if(@$req->input('id_data'))
    			{
	    			$dtjwb=DB::table('tb_jawaban');
	    			$dtjwb->where('id_subkategori',$kye_2->id);
	    			$dtjwb->where('id_data',@$req->input('id_data')); 
	    			@$jwb=$dtjwb->first(); 
	    			@$dat_kat[$i]->sub_kategori[$ii]->jawaban=@unserialize(@$jwb->jawaban)?@unserialize(@$jwb->jawaban):array();
    			}
    			 $ii++;
    		}
    		$i++;
    		
    	}
    	print json_encode(array('data_kat'=>$dat_kat,'dat_id'=>$dat_id));
    }
     public function simpankuis(Request $req)
    {
    	$id_data=@$req->input('id_data');
    	if(!$req->input('id_data'))
    	{
    		$jmldta=DB::table('tb_data')->where('id_user',Auth::user()->id)->count();
    		$jmldta=$jmldta==0?1:$jmldta; 

    		$id_data=DB::table('tb_data')->insertGetId(
    			[
    				'id_data'=>$jmldta,
    				'id_user'=>Auth::user()->id,
					'nama_pos'=>@$req->input('nama_posyandu'),
					'blok'=>@$req->input('blok'),
					'rt_rw'=>@$req->input('rt_rw'),
					'kelurahan'=>@$req->input('kelurahan'),
					'kecamatan'=>@$req->input('kecamatan'),
					'kabupaten'=>'3212'
    			]);  

    	}
    	else
    	{
				$id_data=DB::table('tb_data')->where('id',$id_data)->update(
				[  
					'nama_pos'=>@$req->input('nama_posyandu'),
					'blok'=>@$req->input('blok'),
					'rt_rw'=>@$req->input('rt_rw'),
					'kelurahan'=>@$req->input('kelurahan'),
					'kecamatan'=>@$req->input('kecamatan'),
					'kabupaten'=>'3212'
				]);  
    	}
    	 
    	foreach ($req->input('idsub') as $key)
    	{
    		$get_sub =DB::table('tb_subkategori')->where('id',$key)->first();
    		$attr 	 =@unserialize(@$get_sub->nama_attribut)?unserialize(@$get_sub->nama_attribut):array();
    		 
    		$jawaban=array();
    		if(is_array(@$req->input('jns_'.$key)))
    		{

				foreach ($attr as $ke) 
				{
					foreach (@$req->input('jns_'.$key) as $ke_2) 
					{
							 
						if($ke==$ke_2)
						{
							$jawaban[$ke]=$ke_2;
						} 
					}
				}
    		}else
    		{
    			if(count($attr)<=1)
    			{
					$jawaban[@$attr[0]]=@$req->input('jns_'.$key);
    			}
    			else
    			{
	    			foreach ($attr as $ke_3) 
	    			{
	    				if($ke_3==@$req->input('jns_'.$key))
	    				{ 
							$jawaban[$ke_3]=@$req->input('jns_'.$key);
	    				} 
	    			} 
    			}
    		}  
    		$data['jawaban'] 		=serialize($jawaban);
    		//$data['id_user'] 		=Auth::user()->id; 
    		$data['id_subkategori']=$key;
    		$data['updated_at'] 	=Carbon::now();
    		$get_jwb=DB::table('tb_jawaban')
		    		->where('id_data',$id_data)
		    		->where('id_subkategori',$key) 
		    		->first();
    		if($get_jwb)
    		{
    		DB::table('tb_jawaban')->where('id',@$get_jwb->id)->update($data); 
    		}
    		else
    		{
    			
    		$data['id_data']=$id_data;

    		$data['created_at']=Carbon::now();
    		DB::table('tb_jawaban')->insert($data);

    		} 
    	}

    	print json_encode(array('error'=>false));
    }
    public function listkuis(Request $req)
    {
			$id_data=DB::table('tb_data')->where('id_user',Auth::user()->id)->get();
    		print json_encode(array('list'=>$id_data));

 
    }
    public function kuishpus(Request $req)
    {
			 DB::table('tb_data')->where('id',$req->input('id_hapus'))->delete();
			DB::table('tb_jawaban')->where('id_data',$req->input('id_hapus'))->delete();

    		print json_encode(array('error'=>false));

 
    }
    
    
}
 