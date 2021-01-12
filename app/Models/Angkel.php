<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Angkel extends Model
{
    public $table = 'angkel';

    public function penduduk() {
        return $this->hasOne('\App\Models\Penduduk', 'id', 'id_penduduk');
    }

    public function kk() {
        return $this->hasOne('\App\Models\KK', 'no_kk', 'no_kk');
    }
}
