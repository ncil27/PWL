<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    protected $table = "periode";
    protected $primaryKey = "id_periode";
    public $incrementing = false;
    protected $keyType = "string";
    public $timestamps = false;

    protected $fillable = [
        'id_periode',
        'nama_periode',
    ];
}
