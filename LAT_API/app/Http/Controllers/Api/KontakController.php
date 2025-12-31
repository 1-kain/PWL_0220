<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kontak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KontakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //menampilkan seluruh data
        $kontak = Kontak::all();
        return response()->json([
            'status' => true,
            'message' => 'data berhasil diambil',
            'data' => $kontak
        ],201);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validasi input
        $validator = Validator::make($request->all(),[
            'nama' => 'required|string|max:20',
            'nomor_telepon' => 'required|string|max:20'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => 'validasi error',
                'errors' => $validator->errors()
            ],422);
        }

        $kontak = Kontak::create($request->all());
        return response()->json([
            'status' => true,
            'message' => 'data berhasil ditambahkan',
            'data' => '$kontak'
        ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //melihat detail dari satu id saja
        $kontak = Kontak::findOrFail($id);
        return response()->json([
            'status' => true,
            'message' => 'data berhasil ditemukan',
            'data' => $kontak
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(),[
            'nama' => 'required|string|max:255',
            'nomor_telepon' => 'required|string|max:20'
        ]);

        if($validator->fails()){
            return response()->json([
                'status'=> false,
                'message' => 'validasi error',
                'errors' => $validator->errors()
            ],422);
        }

        $kontak = Kontak::findOrFail($id);
        $kontak -> update($request->all());
        return response()->json([
            'status' => true,
            'message' => 'data berhasil diedit',
            'data' => $kontak
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //menghapus data
        $kontak = Kontak::findOrFail($id);
        $kontak -> delete();
        return response()->json([
            'status' => true,
            'message' => 'data berhasil dihapus',
            'data' => $kontak
        ],204);
    }
}
