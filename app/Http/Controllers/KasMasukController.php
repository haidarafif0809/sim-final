<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KasMasuk;
use App\Kas;
use App\KategoriTransaksi;

class KasMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return KasMasuk::paginate(10);
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

        $request->validate([
            'kas' => 'required|numeric',
            'kategori_transaksi' => 'required|numeric',
            'jumlah' => 'required|numeric',
        ]);
        $kas = Kas::find($request->kas);
        $kategoriTransaksi = KategoriTransaksi::find($request->kategori_transaksi);
        $noTrans = KasMasuk::noKasMasuk();
        $request->request->add(['nama_kas' => $kas->nama]);
        $request->request->add(['no_trans' => $noTrans]);
        $request->request->add(['nama_kategori_transaksi' => $kategoriTransaksi->nama]);
        $kasMasuk = KasMasuk::create($request->all());
    }

    public function search(Request $request){
       return KasMasuk::where('nama','LIKE',"%$request->q%")
                        ->orWhere('alamat','LIKE',"%$request->q%")
                        ->orWhere('no_telp','LIKE',"%$request->q%")
                        ->paginate(10);
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
        return KasMasuk::find($id);
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
        $request->validate([
            'kas' => 'required|numeric',
            'kategori_transaksi' => 'required|numeric',
            'jumlah' => 'required|numeric',
        ]);
        $kas = Kas::find($request->kas);
        $kategoriTransaksi = KategoriTransaksi::find($request->kategori_transaksi);
        $request->request->add(['nama_kas' => $kas->nama]);
        $request->request->add(['nama_kategori_transaksi' => $kategoriTransaksi->nama]);
        $kasMasuk = KasMasuk::find($id)->update($request->all());
        if($kasMasuk) {
           return response(200);
        } else {
           return response(500);
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
        //
        $kasMasuk = KasMasuk::destroy($id);
        if($kasMasuk){
          return response(200);
        } else {
          return response(500);    
        }
    }
}

