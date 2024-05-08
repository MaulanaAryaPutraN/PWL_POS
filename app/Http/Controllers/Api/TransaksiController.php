<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PenjualanDetailModel;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index(){
        return PenjualanDetailModel::all();
    }

    public function store(Request $request){
        $transaksi = PenjualanDetailModel::create($request->all());
        return response()->json($transaksi, 201);
    }

    public function show($transaksi){
        return PenjualanDetailModel::find($transaksi);
    }

    public function update(Request $request, PenjualanDetailModel $transaksi){
        $transaksi->update($request->all());
        return PenjualanDetailModel::find($transaksi);
    }


    public function destroy(PenjualanDetailModel $transaksi){
        $transaksi->delete();
        return response()->json([
            'success'=>true,
            'message'=>'Data terhapus',
        ]);
    }
}
