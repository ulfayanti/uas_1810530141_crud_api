<?php

namespace App\Http\Controllers\Api;

use App\mobile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class mobileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index']]);
    }
    public function index (){
        $data = mobile::all();
        return response()->json($data);
    }
    public function store (Request $request){
        $validasi = Validator::make($request->all(), [
            "no_polisi" => "required",
            "nama_mobile" =>"required",
            "kapasitas"=> "required",
            "harga sewa"=> "required"
        ]);
        if ($validasi->passes()) {
            $data = mobile::create($request->all());
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
        $data = mobile::where('id', $id)->first();
        if (!empty($data)) {
            $validasi = Validator::make($request->all(), [
               "no_polisi" => "required",
               "nama_mobile" => "required",
               "kapasitas" => "required",
               "harga sewa" => "required",
                
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
    $data = mobile::where('id', $id)->first(); 
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




