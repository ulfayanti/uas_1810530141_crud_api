<?php

namespace App\Http\Controllers\Api;

use App\penyewaan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class penywaanController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index']]);
    }

    public function index (){
        // $data = penyewaan::all();
        $data = penyewaan::with('pny')->get();
        return response()->json($data);
    }
    public function store (Request $request){
        $validasi = Validator::make($request->all(), [
            "lama_pesan" => "required",
            "id_mobile" => "required",
            "total" => "required",
            "denda"=> "required",
        ]);
        if ($validasi->passes()) {
            $data = penyewaan::create($request->all());
            return response()->json([
                "pesan" => "berhasil",
                "Data" => $data
            ], 200);
        }
        return response()->json([
            "pesan" => "gagal",
            "data" => $validasi->errors->all()
        ], 404);
    }

    public function update (Request $request, $id){
        $data = penyewaan::where('id', $id)->first();
        if (!empty($data)) {
            $validasi = Validator::make($request->all(), [
                "lama_pesan" => "required",
                "id_mobile" => "required",
                "total" => "required",
                "denda"=> "required",
            ]);
            if ($validasi->passes()) {
                $data->update($request->all());
                return response()->json([
                    "pesan" => "berhasil ubah",
                    "Data" => $data
                ], 200);
            }
            return response()->json([
                "pesan" => "gagal ubah",
                "data" => $validasi->errors->all()
            ], 404);
        }

        
    }
    public function destroy($id) 
    { 
        $data = penyewaan::where('id', $id)->first(); 
        if (empty($data)) { 
            return response()->json([ 
                "Pesan" => "Hapus data Gagal", 
                "Data" => "" 
            ], 404); 
        } 
        $data->delete(); 
        return response()->json([ 
            "Pesan" => "Data penyewaan Berhasil Dihapus", 
            "Data" => $data 
        ], 200); 
    }
   
}
