<?php

namespace App;

// use App\mobile;
use Illuminate\Database\Eloquent\Model;

class penyewaan extends Model
{
    protected $table = 'tbl_penyewaans';
    protected $guarded = ['id'];

    public function pny(){
        return $this->belongsTo(mobile::class, 'id_mobile');
    }
}
