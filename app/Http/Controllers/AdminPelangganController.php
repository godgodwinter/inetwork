<?php

namespace App\Http\Controllers;

use App\Models\pelanggan;
use App\Models\tagihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class AdminPelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($cari='',$orderby='nama',$ascdesc='asc',$tagihan='campur')
    {
        $blnthn=date("Y-m");
		$datas = DB::table('pelanggan')
		->where('nama','like',"%".$cari."%")
		->orwhere('alamat','like',"%".$cari."%")
		->orwhere('panggilan','like',"%".$cari."%")
		->orwhere('paket_nama','like',"%".$cari."%")
		->orwhere('hp','like',"%".$cari."%")
        ->orderBy($orderby,)->orderBy('id','desc')
		->paginate(10);
        // $datas=pelanggan::paginate(10);
        return view('admin.pelanggan.index',compact('datas','blnthn','cari','orderby','ascdesc','tagihan'));
    }

    public function lunas($cari='',$orderby='nama',$ascdesc='asc',$tagihan='lunas')
    {
        $blnthn=date("Y-m");
        return redirect('/admin/pelanggan/'.$blnthn.'/'.$tagihan.'/'.$orderby.'/'.$ascdesc.'/pelangganbln');
    }

    public function belumlunas($cari='',$orderby='nama',$ascdesc='asc',$tagihan='belumlunas')
    {
        $blnthn=date("Y-m");
        return redirect('/admin/pelanggan/'.$blnthn.'/'.$tagihan.'/'.$orderby.'/'.$ascdesc.'/pelangganbln');
    }

    public function pelangganbln(Request $request,$cari='')
    {
        $tagihan=$request->tagihan;
        $blnthn=$request->blnthn;
        $orderby=$request->orderby;
        $ascdesc=$request->ascdesc;
        return redirect('/admin/pelanggan/'.$blnthn.'/'.$tagihan.'/'.$orderby.'/'.$ascdesc.'/pelangganbln');

    }
    public function showpelangganbln($blnthn,$tagihan='campur',$orderby='nama',$ascdesc='asc',$cari='')
    {
        $tagihan=$tagihan;
        $blnthn=$blnthn;
        $orderby=$orderby;
        $ascdesc=$ascdesc;
        // dd($orderby);
        // dd(($orderby==='nama')OR($orderby==='panggilan')OR($orderby==='tgl_gabung')OR($orderby=='status_langganan'));
        if(($orderby==='nama')OR($orderby==='panggilan')OR($orderby==='tgl_gabung')OR($orderby==='status_langganan')OR($orderby==='paket_id')){

        }else{

            $orderby='nama';
        }

        if($tagihan=='lunas'){
            //     // dd('lunas');
                $querytagihan='tagihan.paket_harga <= tagihan.total_bayar';
            }elseif($tagihan=='belumlunas'){
            //     // dd('belumlunas');
                $querytagihan='tagihan.paket_harga > tagihan.total_bayar';

            }else{
                $querytagihan="tagihan.thbln='".$blnthn."'";

            }

    $datas = DB::table('pelanggan')
        ->join('tagihan','tagihan.nik','=','pelanggan.nik')
        ->whereraw($querytagihan)
		->whereraw("tagihan.thbln='".$blnthn."'")
        ->orderBy('pelanggan.'.$orderby,$ascdesc)
		->paginate(10);

        return view('admin.pelanggan.index',compact('datas','blnthn','cari','orderby','ascdesc','tagihan'));


    }
    public function cari(Request $request,$blnthn,$orderby='nama',$ascdesc='asc',$cari='')
    {
        $cari=$request->cari;
        $tagihan=$request->tagihan;
         $blnthn=$request->blnthn;
        $orderby=$request->orderby;
        $ascdesc=$request->ascdesc;
        if($cari===null){
            return redirect('/admin/pelanggan/'.$blnthn.'/'.$tagihan.'/'.$orderby.'/'.$ascdesc.'/pelangganbln');
        }
        return redirect('/admin/pelanggan/'.$blnthn.'/'.$tagihan.'/'.$orderby.'/'.$ascdesc.'/'.$cari.'/pelanggan-cari');

    }
    public function showcari($blnthn,$tagihan,$orderby,$ascdesc,$cari)
	{

        $blnthn=$blnthn;
        $orderby=$orderby;
        $ascdesc=$ascdesc;
        // dd($blnthn);
        // dd(($orderby==='nama')OR($orderby==='panggilan')OR($orderby==='tgl_gabung')OR($orderby=='status_langganan'));
        if(($orderby==='nama')OR($orderby==='panggilan')OR($orderby==='tgl_gabung')OR($orderby==='status_langganan')OR($orderby==='paket_id')){

        }else{

            $orderby='nama';
        }

        // $datas = DB::select( DB::raw("SELECT pelanggan.* FROM `pelanggan`,tagihan WHERE tagihan.thbln='2021-01' AND tagihan.nik=pelanggan.nik AND tagihan.paket_harga>tagihan.total_bayar"));

        if($tagihan=='lunas'){
            //     // dd('lunas');
                $querytagihan='tagihan.paket_harga <= tagihan.total_bayar';
            }elseif($tagihan=='belumlunas'){
            //     // dd('belumlunas');
                $querytagihan='tagihan.paket_harga > tagihan.total_bayar';

            }else{
                $querytagihan="tagihan.thbln='".$blnthn."'";

            }
        $datas = DB::table('pelanggan')
        ->join('tagihan','tagihan.nik','=','pelanggan.nik')
        ->whereraw($querytagihan)
		->whereraw("tagihan.thbln='".$blnthn."'")
		->where('pelanggan.nama','like',"%".$cari."%")
		->orwhere('alamat','like',"%".$cari."%")
        ->whereraw($querytagihan)
		->whereraw("tagihan.thbln='".$blnthn."'")
		->orwhere('panggilan','like',"%".$cari."%")
        ->whereraw($querytagihan)
		->whereraw("tagihan.thbln='".$blnthn."'")
		->orwhere('hp','like',"%".$cari."%")
        ->whereraw($querytagihan)
		->whereraw("tagihan.thbln='".$blnthn."'")
        ->orderBy('pelanggan.'.$orderby,$ascdesc)
		->paginate(10);
        // dd($datas);
        return view('admin.pelanggan.index',compact('datas','blnthn','cari','orderby','ascdesc','tagihan'));
    	// 	// mengambil data dari table pegawai sesuai pencarian data
		// $datas = DB::table('pelanggan')
		// ->where('nama','like',"%".$cari."%")
		// ->orwhere('alamat','like',"%".$cari."%")
		// ->orwhere('panggilan','like',"%".$cari."%")
		// ->orwhere('paket_nama','like',"%".$cari."%")
		// ->orwhere('hp','like',"%".$cari."%")
		// ->orwhere('hp','like',"%".$cari."%")
        // ->orderBy($orderby,$ascdesc)->paginate(10);

    	// 	// mengirim data pelanggan ke view index

        // if($tagihan=='lunas'){
        //     // dd('lunas');
        //     return view('admin.pelanggan.index-lunas',compact('datas','blnthn','cari','orderby','ascdesc','tagihan'));
        // }elseif($tagihan=='belumlunas'){
        //     // dd('belumlunas');
        //     return view('admin.pelanggan.index-belumlunas',compact('datas','blnthn','cari','orderby','ascdesc','tagihan'));
        // }else{
        //     return view('admin.pelanggan.index',compact('datas','blnthn','cari','orderby','ascdesc','tagihan'));
        // }
        // return view('admin.pelanggan.index',compact('datas','blnthn','cari','orderby','ascdesc','tagihan'));

	}


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $blnthn=date("Y-m");
        return view('admin.pelanggan.create',compact('blnthn'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nik'=>'required|unique:pelanggan',
            'nama'=>'required',
            'alamat'=>'required',
            'hp'=>'required',
            'paket_id'=>'required',
            'tgl_gabung'=>'required',
            'status_langganan'=>'required',
            'kordinat_rumah'=>'required',
            'letakserver_id'=>'required'
        ],
        [
            'nik.required'=>'nik harus diisi',
            'nik.unique'=>'nik sudah digunakan'
        ]);

        //periksa apakah nik  sudah ada
        $ambildatanik= DB::table('pelanggan')
            ->where('nik',$request->nik)
            ->count();
        if($ambildatanik>0){
            return redirect(URL::to('/').'/admin/pelanggan')->with('status','Gagal, NIK sudah ada!');

        }


        //ambil nama PAKET
        $ambilpaket = DB::table('paket')->where('id',$request->paket_id)->get();
        foreach($ambilpaket as $ambil){
            $paket_nama=$ambil->nama;
            $paket_harga=$ambil->harga;
            $paket_kecepatan=$ambil->kecepatan;
        }

        //ambil nama letakserver
        $ambilnamas4rver = DB::table('letakserver')->where('id',$request->letakserver_id)->get();
        foreach($ambilnamas4rver as $ambil2){
            $letakserver_nama=$ambil2->nama;
            $letakserver_koordinat=$ambil2->koordinat;
        }

       // simpan ke tabel pelanggan
       DB::table('pelanggan')->insert(
        array(
               'nik'     =>   $request->nik,
               'nama'     =>   $request->nama,
               'alamat'     =>   $request->alamat,
               'hp'     =>   $request->hp,
               'tgl_gabung'     =>   $request->tgl_gabung,
               'paket_id'     =>   $request->paket_id,
               'paket_nama'     =>   $paket_nama,
               'paket_harga'=>$paket_harga,
               'kordinat_rumah'     =>   $request->kordinat_rumah,
               'letakserver_id'     =>   $request->letakserver_id,
               'status_langganan'     =>   $request->status_langganan,
               'letakserver_nama'     =>   $letakserver_nama,
               'letakserver_koordinat'     =>   $letakserver_koordinat,
               'paket_kecepatan'     =>   $paket_kecepatan,
               'panggilan'     =>   $request->panggilan,
               'created_at'=>date("Y-m-d H:i:s"),
               'updated_at'=>date("Y-m-d H:i:s")
        ));

        //periksa apakah nik thbln skrg sudah ada
        $ambildatatagihan= DB::table('tagihan')
            ->where('nik',$request->nik)
            ->where('thbln', date("Y-m"))
            ->count();

        if($ambildatatagihan>0){
            //update data tagihan nik&&blnskrg
            // dd("update");

            DB::table('tagihan')
            ->where('nik', $request->nik)
            ->where('thbln', date("Y-m"))
            ->update([
                'nama'     =>   $request->nama,
                'paket_id'     =>   $request->paket_id,
               'paket_nama'     =>   $paket_nama,
               'paket_harga'     =>   $paket_harga,
               'paket_kecepatan'     =>   $paket_kecepatan,
            ]);
            return redirect('/admin/pelanggan')->with('status','Data berhasil ditambah dan tagihan bulan ini berhasil diupdate!');

        }else{
            //simpan
            // dd("simpan");


        // simpan ke tabel tagihan
       DB::table('tagihan')->insert(
        array(
               'nik'     =>   $request->nik,
               'nama'     =>   $request->nama,
               'total_bayar'     =>   0,
               'tgl_bayar'     =>   date("Y-m-d H:i:s"),
               'paket_id'     =>   $request->paket_id,
               'paket_nama'     =>   $paket_nama,
               'paket_harga'     =>   $paket_harga,
               'paket_kecepatan'     =>   $paket_kecepatan,
               'thbln'     =>   date("Y-m"),
               'created_at'=>date("Y-m-d H:i:s"),
               'updated_at'=>date("Y-m-d H:i:s")
        )
    );

    return redirect(URL::to('/').'/admin/pelanggan')->with('status','Data berhasil di tambahkan!');
        }



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $datas = DB::table('pelanggan')->where('id',$id)->get();
        return view('admin.pelanggan.edit',compact('datas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'nik'=>'required|unique:pelanggan,nik,'. $id,
            'nama'=>'required',
            'alamat'=>'required',
            'hp'=>'required',
            'paket_id'=>'required',
            'tgl_gabung'=>'required',
            'status_langganan'=>'required',
            'kordinat_rumah'=>'required',
            'letakserver_id'=>'required'
        ],
        [
            'nik.required'=>'nik harus diisi',
            'nik.unique'=>'nik telah digunakan',
        ]);

        $paket_nama="Paket Tidak ditemukan atau terhapus";
        //ambil nama PAKET
        $ambilpaket = DB::table('paket')->where('id',$request->paket_id)->get();
        foreach($ambilpaket as $ambil){
            $paket_nama=$ambil->nama;
            $paket_harga=$ambil->harga;
            $paket_kecepatan=$ambil->kecepatan;
        }

        $letakserver_nama="Server Tidak ditemukan atau terhapus";
        $letakserver_koordinat="Koordinat Server Tidak ditemukan atau terhapus";
        //ambil nama letakserver
        $ambilnamas4rver = DB::table('letakserver')->where('id',$request->letakserver_id)->get();
        foreach($ambilnamas4rver as $ambil2){
            $letakserver_nama=$ambil2->nama;
            $letakserver_koordinat=$ambil2->koordinat;
        }
         //aksi update
         pelanggan::where('id',$id)
         ->update([
             'nik'=>$request->nik,
             'nama'=>$request->nama,
             'alamat'=>$request->alamat,
             'hp'=>$request->hp,
             'status_langganan'=>$request->status_langganan,
             'tgl_gabung'=>$request->tgl_gabung,
             'paket_id'=>$request->paket_id,
             'paket_nama'=>$paket_nama,
             'paket_harga'=>$paket_harga,
             'paket_id'=>$request->paket_id,
             'paket_kecepatan'     =>   $paket_kecepatan,
             'kordinat_rumah'     =>   $request->kordinat_rumah,
             'letakserver_id'     =>   $request->letakserver_id,
             'status_langganan'     =>   $request->status_langganan,
             'letakserver_nama'     =>   $letakserver_nama,
             'letakserver_koordinat'     =>   $letakserver_koordinat,
             'paket_kecepatan'     =>   $paket_kecepatan,
             'panggilan'     =>   $request->panggilan,
             'updated_at'=>date("Y-m-d H:i:s")
         ]);


        //periksa apakah nik thbln skrg sudah ada
        $ambildatatagihan= DB::table('tagihan')
        ->where('nik',$request->nik)
        ->where('thbln', date("Y-m"))
        ->count();

    if($ambildatatagihan>0){
        //update data tagihan nik&&blnskrg
        // dd("update");

        DB::table('tagihan')
        ->where('nik', $request->nik)
        ->where('thbln', date("Y-m"))
        ->update([
            'nama'     =>   $request->nama,
            'paket_id'     =>   $request->paket_id,
           'paket_nama'     =>   $paket_nama,
           'paket_harga'     =>   $paket_harga,
           'paket_kecepatan'     =>   $paket_kecepatan,
        ]);
        return redirect('/admin/pelanggan')->with('status','Data berhasil ditambah dan tagihan bulan ini berhasil diupdate!');

    }else{
        //simpan
        // dd("simpan");


    // simpan ke tabel tagihan
   DB::table('tagihan')->insert(
    array(
           'nik'     =>   $request->nik,
           'nama'     =>   $request->nama,
           'total_bayar'     =>   0,
           'tgl_bayar'     =>   date("Y-m-d H:i:s"),
           'paket_id'     =>   $request->paket_id,
           'paket_nama'     =>   $paket_nama,
           'paket_harga'     =>   $paket_harga,
           'paket_kecepatan'     =>   $paket_kecepatan,
           'thbln'     =>   date("Y-m"),
           'created_at'=>date("Y-m-d H:i:s"),
           'updated_at'=>date("Y-m-d H:i:s")
    )
);

return redirect(URL::to('/').'/admin/pelanggan')->with('status','Data berhasil di update!');
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        pelanggan::destroy($id);
        return redirect(URL::to('/').'/admin/pelanggan')->with('status','Data berhasil dihapus!');
    }
}
