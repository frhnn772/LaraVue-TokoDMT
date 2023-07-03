<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produk = Produk::orderBy('created_at', 'DESC')->get();
        $response = [
            'message' => 'Data Produk dari perubahan terbaru',
            'data' => $produk
        ];
        return response()->json($response, Response::HTTP_OK);
    }
    public function bestproduct()
    {
        $produk = Produk::latest()->take(3)->get();
        $response = [
            'message' => 'Produk Terbaik',
            'data' => $produk
        ];
        return response()->json($response, Response::HTTP_OK);
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
            'id_produk' => ['required','numeric'],
            'produk' => ['required'],
            'deskripsi' => ['required'],
            'harga' => ['required','numeric'],
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(),
            Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        try {
            $produk = Produk::create($request->all());
            $response = [
                'pesan' => 'Berhasil Tambah Produk Baru',
                'data' => $produk
            ];
            return response()->json($response, Response::HTTP_CREATED);
        }catch(QueryException $e){
            return response()->json([
                'pesan' => "Gagal Menambah Produk" .$e->errorInfo]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function show(Produk $produk)
    {
        $produk = Produk::findORFail($produk->id_produk);
        $response = [
            'pesan' => 'Detail Produk',
            'data' => $produk
        ];
        // return response()->json(['data' => $response]);
        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function edit(Produk $produk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produk $produk)
    {
        $produk = Produk::findORFail($produk->id_produk);

        $validator = Validator::make($request->all(), [
            'id_produk' => ['required'],
            'produk' => ['required'],
            'harga' => ['required'],
            'deskripsi' => ['required'],
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(),
            Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        try {
            $produk->update($request->all());
            $response = [
                'pesan' => 'Berhasil Mengubah Produk',
                'data' => $produk
            ];
            return response()->json($response, Response::HTTP_OK);
        }catch(QueryException $e){
            return response()->json([
                'message' => "Failed" . $e->errorInfo
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produk $produk)
    {
        $produk = Produk::findOrFail($produk->id_produk);
        try {
            $produk->delete();
            $response = [
                'pesan' => 'Berhasil Menghapus Produk',
            ];
            return response()->json(['message' => $response]);
        }catch(QueryException $e){
            return response()->json([
                'pesan' => "Gagal Menghapus Produk" .$e->errorInfo
            ]);
        }
    }
}
