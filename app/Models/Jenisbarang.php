<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jenisbarang extends Model
{
    public $table = 'jenis_barang';

    public $timestamps = false;

    public function stokbarang() {
        return $this->hasMany('\App\Models\Stokbarang', 'id_jenis', 'id');
    }
}
