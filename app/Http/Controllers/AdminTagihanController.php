<?php

namespace App\Http\Controllers;

use App\Models\tagihan;
use App\Models\tagihandetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class AdminTagihanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($cari='',$orderby='nama',$ascdesc='asc',$tagihan='campur')
    {
        $blnthn=date("Y-m");
        $datas = DB::table('tagihan')
        ->whereMonth('tgl_bayar', '=', date("m",strtotime($blnthn)))
        ->whereYear('tgl_bayar', '=', date("Y",strtotime($blnthn)))
        ->orderBy('updated_at', 'desc')->paginate(10);

        // $today = Carbon::now()->isoFormat('D MMMM Y');
        return view('admin.tagihan.index',compact('datas','blnthn','cari','orderby','ascdesc','tagihan'));
    }
    public function lunas($cari='',$orderby='nama',$ascdesc='asc',$tagihan='lunas')
    {
        $blnthn=date("Y-m");
        return redirect('/admin/tagihan/'.$blnthn.'/'.$tagihan.'/'.$orderby.'/'.$ascdesc.'/tagihanbln');
    }

    public function belumlunas($cari='',$orderby='nama',$ascdesc='asc',$tagihan='belumlunas')
    {
        $blnthn=date("Y-m");
        return redirect('/admin/tagihan/'.$blnthn.'/'.$tagihan.'/'.$orderby.'/'.$ascdesc.'/tagihanbln');
    }
    public function tagihanbln(Request $request)
    {
        $blnthn=$request->blnthn;
        return redirect('/admin/tagihan/'.$blnthn.'/tagihanbln');
    }
    public function showtagihanbln($blnthn,$tagihan='campur',$orderby='nama',$ascdesc='asc',$cari='')
    {

        $tagihan=$tagihan;
        $blnthn=$blnthn;
        $orderby=$orderby;
        $ascdesc=$ascdesc;
        if(($orderby==='nama')OR($orderby==='tgl_bayar')OR($orderby==='paket_id')){

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


    $datas = DB::table('tagihan')
    // ->join('tagihan','tagihan.nik','=','pelanggan.nik')
    ->whereMonth('tgl_bayar', '=', date("m",strtotime($blnthn)))
    ->whereYear('tgl_bayar', '=', date("Y",strtotime($blnthn)))
    ->whereraw($querytagihan)
    ->whereraw("tagihan.thbln='".$blnthn."'")
    ->orderBy('tagihan.'.$orderby,$ascdesc)
    ->paginate(10);

        // $blnthn=$request->blnthn;
        // $datas = DB::table('tagihan')
        // ->whereMonth('tgl_bayar', '=', date("m",strtotime($blnthn)))
        // ->whereYear('tgl_bayar', '=', date("Y",strtotime($blnthn)))
        // ->orderBy('updated_at', 'desc')->paginate(10);

        // $today = Carbon::now()->isoFormat('D MMMM Y');
        return view('admin.tagihan.index',compact('datas','blnthn','cari','orderby','ascdesc','tagihan'));
    }

    public function cari(Request $request,$blnthn,$orderby='nama',$ascdesc='asc',$cari='')
    {
        $cari=$request->cari;
        $tagihan=$request->tagihan;
         $blnthn=$request->blnthn;
        $orderby=$request->orderby;
        $ascdesc=$request->ascdesc;

        if($cari===null){
            return redirect('/admin/tagihan/'.$blnthn.'/'.$tagihan.'/'.$orderby.'/'.$ascdesc.'/tagihanbln');
        }
        return redirect('/admin/tagihan/'.$blnthn.'/'.$tagihan.'/'.$orderby.'/'.$ascdesc.'/'.$cari.'/tagihan-cari');

    }
    public function showcari($blnthn,$tagihan,$orderby,$ascdesc,$cari)
	{

        $blnthn=$blnthn;
        $orderby=$orderby;
        $ascdesc=$ascdesc;

        if(($orderby==='nama')OR($orderby==='tgl_bayar')OR($orderby==='paket_id')){

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


        $datas = DB::table('tagihan')
        // ->join('tagihan','tagihan.nik','=','pelanggan.nik')
        ->whereMonth('tgl_bayar', '=', date("m",strtotime($blnthn)))
        ->whereYear('tgl_bayar', '=', date("Y",strtotime($blnthn)))
        ->whereraw($querytagihan)
        ->whereraw("tagihan.thbln='".$blnthn."'")
		->where('tagihan.nama','like',"%".$cari."%")

		->orwhere('tagihan.paket_harga','like',"%".$cari."%")
        ->whereraw($querytagihan)
		->whereraw("tagihan.thbln='".$blnthn."'")
        ->whereMonth('tgl_bayar', '=', date("m",strtotime($blnthn)))
        ->whereYear('tgl_bayar', '=', date("Y",strtotime($blnthn)))

		->orwhere('tagihan.tgl_bayar','like',"%".$cari."%")
        ->whereraw($querytagihan)
		->whereraw("tagihan.thbln='".$blnthn."'")
        ->whereMonth('tgl_bayar', '=', date("m",strtotime($blnthn)))
        ->whereYear('tgl_bayar', '=', date("Y",strtotime($blnthn)))

		->orwhere('tagihan.nik','like',"%".$cari."%")
        ->whereraw($querytagihan)
		->whereraw("tagihan.thbln='".$blnthn."'")
        ->whereMonth('tgl_bayar', '=', date("m",strtotime($blnthn)))
        ->whereYear('tgl_bayar', '=', date("Y",strtotime($blnthn)))

        ->orderBy('tagihan.'.$orderby,$ascdesc)
        ->paginate(10);

        // dd($datas);
    		// mengirim data pegawai ke view index
        return view('admin.tagihan.index',compact('datas','blnthn','cari','orderby','ascdesc','tagihan'));

	}
    public function tagihansync(Request $request)
    {
        $blnthn=$request->blnthn;
        // dd($request);
        //tampilkan data pelanggan aktif
        $datas = DB::table('pelanggan')
        ->where('status_langganan', '=', 'Aktif')
        ->get();

        //cek nik per blnthn
        foreach($datas as $d){

            $dataniktagihan = DB::table('tagihan')
            ->where('nik', '=', $d->nik)
            ->where('thbln', '=', $request->blnthn)
            ->count();
            // dd($dataniktagihan);
            if($dataniktagihan>0){
                //update
         //update paket jika sudah ada

                DB::table('tagihan')
                ->where('nik', $request->nik)
                ->where('thbln', date("Y-m"))
                ->update([
                    'paket_id'     =>   $d->paket_id,
                    'tgl_bayar'     =>   $request->blnthn.date("-d H:i:s"),
                    'nama'     =>   $d->nama,
                    'paket_nama'     =>   $d->paket_nama,
                    'paket_kecepatan'     =>   $d->paket_kecepatan,
                    'paket_harga'     =>   $d->paket_harga,

                ]);
            }else{

                //insert jika belum ada
                //simpan
                DB::table('tagihan')->insert(
                    array(
                           'nik'     =>   $d->nik,
                           'paket_id'     =>   $d->paket_id,
                           'total_bayar'     =>   '0',
                           'tgl_bayar'     =>   $request->blnthn.date("-d H:i:s"),
                           'nama'     =>   $d->nama,
                           'thbln'     =>   $blnthn,
                           'paket_nama'     =>   $d->paket_nama,
                           'paket_kecepatan'     =>   $d->paket_kecepatan,
                           'paket_harga'     =>   $d->paket_harga,
                           'created_at'=>date("Y-m-d H:i:s"),
                           'updated_at'=>date("Y-m-d H:i:s")
                    )
               );
            }
        }

        return redirect(URL::to('/').'/admin/tagihanbln/?blnthn='.$blnthn)->with('status','Data Tagihan berhasil disynkronkan dengan data pelanggan!');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        tagihan::destroy($id);
        return redirect(URL::to('/').'/admin/tagihan')->with('status','Data berhasil dihapus!');
    }

    public function bayar($id)
    {
        // dd($id);
        // ambil data pelanggan
            $datas = DB::table('pelanggan')->where('nik',$id)->get();

            foreach ($datas as $data){

                //cek apakah paket id ada di tabel paket
                $jmldata = DB::table('paket')
                ->where('id', '=', $data->paket_id)
                ->count();

                //jika paket internet tidak ada
                if($jmldata==0){

                    return redirect('/admin/pelanggan')->with('status','Paket Internet tidak ditemukan, Periksa dan ubah dahulu!');
                }

                //jika status langganan tidak aktif
                if(($data->status_langganan)!="Aktif"){

                    return redirect('/admin/pelanggan')->with('status','Status Langganan <b>Tidak Aktif, Periksa dan ubah dahulu!');
                }

                //ambil harga paket
            $dataspaket = DB::table('paket')->where('id',$data->paket_id)->get();
            foreach ($dataspaket as $dp){
                    $paket_nama=$dp->nama;
                    $paket_kecepatan=$dp->kecepatan;
                    $paket_harga=$dp->harga;
            }

                //periksa apakah nik sudah bayar
                $cariapakahsudahbayar = DB::table('tagihan')
                ->where('nik', '=', $data->nik)
                ->whereYear('tgl_bayar', '=', date("Y"))
                ->whereMonth('tgl_bayar', '=', date("m"))
                ->count();

                //jika data sudah ada/sudah bayar tagihan
                if($cariapakahsudahbayar>0){
                    //update
                     // ambil data total pembayaran per thbln dipilih
                     $ambiltotalterbayar= DB::table('tagihan')
                     ->where('nik', '=', $data->nik)
                     ->where('thbln', '=',date("Y-m"))
                     ->sum('total_bayar');
                     // dd($ambiltotalterbayar);

                     //cek jika ditambahkan nominal bayar saat ini melebihi atau tidak
                     if(($ambiltotalterbayar+$paket_harga)>$paket_harga){
                         //jika melebihi alihkan kehalaman tambah

                         return redirect('/admin/pelanggan')->with('status','Pembayaran Tagihan Gagal ditambahkan!');
                     }else{
                             //simpan jika tidak melebihi
                              //simpan
                 DB::table('tagihan')->insert(
                     array(
                            'nik'     =>   $data->nik,
                            'paket_id'     =>   $data->paket_id,
                            'total_bayar'     =>   $paket_harga,
                            'thbln'     =>   date("Y-m"),
                            'tgl_bayar'     =>   date("Y-m-d H:i:s"),
                            'nama'     =>   $data->nama,
                            'paket_nama'     =>   $paket_nama,
                            'paket_kecepatan'     =>   $paket_kecepatan,
                            'paket_harga'     =>   $paket_harga,
                            'created_at'=>date("Y-m-d H:i:s"),
                            'updated_at'=>date("Y-m-d H:i:s")
                     )
                );
                return redirect('/admin/tagihan')->with('status','Pembayaran Tagihan Berhasil ditambahkan!');

             }
                }else{

                    //simpan
                    DB::table('tagihan')->insert(
                        array(
                               'nik'     =>   $data->nik,
                               'paket_id'     =>   $data->paket_id,
                               'total_bayar'     =>   $paket_harga,
                               'tgl_bayar'     =>   date("Y-m-d H:i:s"),
                               'nama'     =>   $data->nama,
                               'paket_nama'     =>   $paket_nama,
                               'paket_kecepatan'     =>   $paket_kecepatan,
                               'paket_harga'     =>   $paket_harga,
                               'thbln'     =>   date("Y-m"),
                               'created_at'=>date("Y-m-d H:i:s"),
                               'updated_at'=>date("Y-m-d H:i:s")
                        )
                   );
                }
                return redirect('/admin/tagihan')->with('status','Pembayaran Tagihan Berhasil ditambahkan!');
//penutup data pelanggan
            }

        //jika tidak ada maka kembali

        // jika ada lanjut
        // simpan tagihan

    }


    public function bayarinternet(Request $request)
    {
        // ambil data pelanggan
            $datas = DB::table('pelanggan')->where('nik',$request->nik)->get();


            foreach ($datas as $data){

                //cek apakah paket id ada di tabel paket
                $jmldata = DB::table('paket')
                ->where('id', '=', $data->paket_id)
                ->count();

                //jika paket internet tidak ada
                if($jmldata==0){

                    return redirect('/admin/pelanggan')->with('status','Paket Internet tidak ditemukan, Periksa dan ubah dahulu!');
                }

                //jika status langganan tidak aktif
                if(($data->status_langganan)!="Aktif"){

                    return redirect('/admin/pelanggan')->with('status','Status Langganan <b>Tidak Aktif, Periksa dan ubah dahulu!');
                }

                //ambil harga paket
            $dataspaket = DB::table('paket')->where('id',$data->paket_id)->get();
            foreach ($dataspaket as $dp){
                    $paket_nama=$dp->nama;
                    $paket_kecepatan=$dp->kecepatan;
                    $paket_harga=$dp->harga;
            }

                //periksa apakah nik sudah bayar
                $cariapakahsudahbayar = DB::table('tagihan')
                ->where('nik', '=', $data->nik)
                ->whereYear('tgl_bayar', '=', date("Y"))
                ->whereMonth('tgl_bayar', '=', date("m"))
                ->count();



                //jika data sudah ada/sudah bayar tagihan
                if($cariapakahsudahbayar>0){
                    //update
                    // ambil data total pembayaran per thbln dipilih
                    $ambiltotalterbayar= DB::table('tagihan')
                        ->where('nik', '=', $data->nik)
                        ->where('thbln', '=',$request->thbln)
                        ->sum('total_bayar');
                        // dd($ambiltotalterbayar);

                        //cek jika ditambahkan nominal bayar saat ini melebihi atau tidak
                        if(($ambiltotalterbayar+$request->nominal)>$paket_harga){
                            //jika melebihi alihkan kehalaman tambah

                            return redirect('/dashboard')->with('status','Pembayaran Tagihan Gagal ditambahkan!');
                        }else{
                                //simpan jika tidak melebihi
                                 //simpan
                    DB::table('tagihan')->insert(
                        array(
                               'nik'     =>   $data->nik,
                               'paket_id'     =>   $data->paket_id,
                               'total_bayar'     =>   $request->nominal,
                               'thbln'     =>   $request->thbln,
                               'tgl_bayar'     =>   date("Y-m-d H:i:s"),
                               'nama'     =>   $data->nama,
                               'paket_nama'     =>   $paket_nama,
                               'paket_kecepatan'     =>   $paket_kecepatan,
                               'paket_harga'     =>   $paket_harga,
                               'created_at'=>date("Y-m-d H:i:s"),
                               'updated_at'=>date("Y-m-d H:i:s")
                        )
                   );
                   return redirect('/admin/tagihan')->with('status','Pembayaran Tagihan Berhasil ditambahkan!');

                }

                // return redirect('/admin/pelanggan')->with('status','Pembayaran gagal, Pelanggan sudah membayar pada bulan ini!');
                }else{

                    // dd($request->nominal);
                    //simpan
                    DB::table('tagihan')->insert(
                        array(
                               'nik'     =>   $data->nik,
                               'paket_id'     =>   $data->paket_id,
                               'total_bayar'     =>   $request->nominal,
                               'thbln'     =>   $request->thbln,
                               'tgl_bayar'     =>   date("Y-m-d H:i:s"),
                               'nama'     =>   $data->nama,
                               'paket_nama'     =>   $paket_nama,
                               'paket_kecepatan'     =>   $paket_kecepatan,
                               'paket_harga'     =>   $paket_harga,
                               'created_at'=>date("Y-m-d H:i:s"),
                               'updated_at'=>date("Y-m-d H:i:s")
                        )
                   );
                }
                return redirect('/admin/tagihan')->with('status','Pembayaran Tagihan Berhasil ditambahkan!');
//penutup data pelanggan
            }

        //jika tidak ada maka kembali

        // jika ada lanjut
        // simpan tagihan

    }


    //bayar sekarang
    public function bayarsekarang(Request $request)
    {

        $totalsetelahditambahbaru=($request->ambiltagihankurangberapa+$request->nominal);
        // dd($request->ambiltagihankurangberapa);
        // dd($request->paket_kecepatan);
        //
        $request->validate([
            'nominal'=>'required|numeric'

        ],
        [
            'nominal.required'=>'nominal harus diisi',
            'nominal.numeric'=>'nominal harus angka'

        ]);
   $ambildatatagihan= DB::table('tagihan')
            ->where('nik',$request->nik)
            ->where('thbln', date("Y-m"))
            ->count();

    // jika ada
if($ambildatatagihan>0){
        //update data tagihan nik&&blnskrg
        // dd("update");


        DB::table('tagihan')
        ->where('nik', $request->nik)
        ->where('thbln', date("Y-m"))
        ->update([
            'total_bayar'     =>   $totalsetelahditambahbaru,

        ]);


    }else{
        //simpan
        // dd("simpan");


    // simpan ke tabel tagihan
   DB::table('tagihan')->insert(
    array(
           'nik'     =>   $request->nik,
           'nama'     =>   $request->nama,
           'total_bayar'     =>   $request->nominal,
           'tgl_bayar'     =>   date("Y-m-d H:i:s"),
           'paket_id'     =>   $request->paket_id,
           'paket_nama'     =>   $request->paket_nama,
           'paket_harga'     =>   $request->paket_harga,
           'paket_kecepatan'     =>   $request->paket_kecepatan,
           'thbln'     =>   date("Y-m"),
           'created_at'=>date("Y-m-d H:i:s"),
           'updated_at'=>date("Y-m-d H:i:s")
    )
);

// return redirect(URL::to('/').'/admin/pelanggan')->with('status','Data berhasil di tambahkan!');
    }


//ambiltagihanid
   $ambildatatagihanid= DB::table('tagihan')
   ->where('nik',$request->nik)
   ->where('thbln', date("Y-m"))
   ->get();

   foreach($ambildatatagihanid as $dataidtagihan){
    $datatagihanid=$dataidtagihan->id;
   }
    //simpan ke tabel tagihan detail
   DB::table('tagihandetail')->insert(
    array(
           'tagihan_id'     =>   $datatagihanid,
           'nik'     =>   $request->nik,
           'nama'     =>   $request->nama,
           'bayar'     =>   $request->nominal,
           'paket_id'     =>   $request->paket_id,
           'paket_harga'     =>   $request->paket_harga,
           'paket_kecepatan'     =>   $request->paket_kecepatan,
           'thbln'     =>   date("Y-m"),
           'created_at'=>date("Y-m-d H:i:s"),
           'updated_at'=>date("Y-m-d H:i:s")
    )
);

return redirect(URL::to('/').'/admin/pelanggan')->with('status','Pembayaran berhasil di tambahkan!');
    }

    public function detail($id)
    {
// dd($id);

        $datas = DB::table('tagihan')
        ->where('id', $id)
        ->orderBy('updated_at', 'desc')->get();

        // $today = Carbon::now()->isoFormat('D MMMM Y');
        return view('admin.tagihan.detail',compact('datas'));
    }
    public function deletechecked(Request $request)
    {
        //ambil tagihan_id
        $dataid = DB::table('tagihandetail')
        ->where('id', $request->ids)
        ->orderBy('updated_at', 'desc')->get();

        foreach ($dataid as $di){
            $tagihan_id=$di->tagihan_id;
            $thbln=$di->thbln;
        }






        //hapus
        $ids=$request->ids;
        tagihandetail::whereIn('id',$ids)->delete();

        $ambiltotaltelahdibayar = DB::table('tagihandetail')
        ->where('tagihan_id',$tagihan_id)
        ->sum('bayar');

         // update totalbayar di tagihan

         DB::table('tagihan')
         ->where('id', $tagihan_id)
         ->where('thbln',$thbln)
         ->update([
             'total_bayar'     =>   $ambiltotaltelahdibayar
         ]);


        // load ulang
        $datas = DB::table('tagihan')
        ->where('id', $tagihan_id)
        ->orderBy('updated_at', 'desc')->get();

        // $today = Carbon::now()->isoFormat('D MMMM Y');
        return view('admin.tagihan.detail',compact('datas'));

    }


}
