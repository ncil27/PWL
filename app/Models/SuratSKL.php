<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratSKL extends Model
{
    protected $table = "surat_ket_lulus";
    protected $primaryKey = "id_surat_lulus";
    public $incrementing = false;
    public $increment = false;
    protected $fillable = [
        // 'id_surat_lhs',
        'id_pengajuan',
        'tgl_lulus',
        'created_at',
    ];
    
    public $timestamps = true; // Untuk `created_at`
}
