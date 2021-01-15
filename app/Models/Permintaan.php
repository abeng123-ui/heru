<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permintaan extends Model
{
    public $table = 'permintaan';

    public $timestamps = false;

    public function stokbarang() {
        return $this->belongsTo('\App\Models\Stokbarang', 'kode_brg', 'kode_brg');
    }

    public function jenisbarang() {
        return $this->belongsTo('\App\Models\Jenisbarang', 'id_jenis', 'id');
    }
}
