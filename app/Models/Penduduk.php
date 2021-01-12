<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
    public $table = 'penduduk';

    public function data_agama() {
        return $this->belongsTo('\App\Models\Agama', 'agama', 'id');
    }

    public function angkel() {
        return $this->hasOne('\App\Models\Angkel', 'id_penduduk', 'id');
    }
}
