<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Penghuni extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'penghuni';
    protected $fillable = [
        'nama','asal','no_hp','id_kamar','tgl_masuk','lama_sewa'
    ];
}
