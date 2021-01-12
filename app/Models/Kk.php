<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kk extends Model
{
    public $table = 'kk';

    public function angkel() {
        return $this->hasMany('\App\Models\Angkel', 'no_kk', 'no_kk');
    }

}
