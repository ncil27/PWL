<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratPengantar extends Model
{

    protected $table = 'surat_pengantar';
    protected $primaryKey = 'id_surat_pengantar';
    public $incrementing = false;

    protected $fillable = [
        // 'id_surat_pengantar',
        'id_pengajuan',
        'penerima',
        'kode_matkul',
        'id_periode',
        'tujuan',
        'topik',
        'data_mhs',
        'created_at',
    ];

    public $timestamps = true; // Untuk `created_at`
}
