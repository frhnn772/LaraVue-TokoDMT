<?php

namespace App\Http\Controllers;

use App\Models\Pembeli;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class PembeliController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pembeli = Pembeli::with('produk')->get();
        return response()->json([
            'data' => $pembeli
        ]);
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
        $validator = Validator::make($request->all(), [
            // 'id_pembeli' => ['required'],
            'nama_pembeli' => ['required'],
            'id_produk' => ['required'],
            'jumlah_beli' => ['required'],
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(),
            Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        try {
            $pembeli = Pembeli::create($request->all());
            $response = [
                'pesan' => 'Berhasil Menambahkan Orderan Baru',
                'pembeli' => $pembeli
            ];
            return response()->json($response, Response::HTTP_CREATED);
        }catch(QueryException $e){
            return response()->json([
                'pesan' => "Gagal Menambah Orderan" .$e->errorInfo]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembeli  $pembeli
     * @return \Illuminate\Http\Response
     */
    public function show(Pembeli $pembeli)
    {
        $pembeli = Pembeli::findORFail($pembeli->id_pembeli);
        $response = [
            'pesan' => 'Berhasil Temukan Orderan',
            'produk' => $pembeli
        ];
        return response()->json(['message' => $response]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembeli  $pembeli
     * @return \Illuminate\Http\Response
     */
    public function edit(Pembeli $pembeli)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembeli  $pembeli
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pembeli $pembeli)
    {
        $pembeli = Pembeli::findORFail($pembeli->id_pembeli);

        $validator = Validator::make($request->all(), [
            'id_pembeli' => ['required'],
            'nama_pembeli' => ['required'],
            'id_produk' => ['required'],
            'jumlah_beli' => ['required'],
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(),
            Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        try {
            $pembeli->update($request->all());
            $response = [
                'pesan' => 'Berhasil Mengubah Orderan',
                'pembeli' => $pembeli
            ];
            return response()->json(['message' => $response]);
        }catch(QueryException $e){
            return response()->json([
                'pesan' => "Gagal Mengubah Orderan" .$e->errorInfo]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembeli  $pembeli
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pembeli $pembeli)
    {
        $pembeli = Pembeli::findORFail($pembeli->id_pembeli);

        try {
            $pembeli->delete();
            $response = [
                'pesan' => 'Berhasil Menghapus Orderan',
            ];
            return response()->json(['message' => $response]);
        }catch(QueryException $e){
            return response()->json([
                'pesan' => "Gagal Menghapus Orderan" .$e->errorInfo
            ]);
        }
    }
}
