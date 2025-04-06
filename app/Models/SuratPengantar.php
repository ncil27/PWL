<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratPengantar extends Model
{
    use HasFactory;

    protected $table = 'surat_pengantar';
    protected $primaryKey = 'id_surat_pengantar';
    public $incrementing = false;

    protected $fillable = [
        // 'id_surat_pengantar',
        'id_pengajuan',
        'penerima',
        'kode_matkul',
        'periode',
        'tujuan',
        'topik',
        'data_mhs',
    ];

    public $timestamps = true; // Untuk `created_at`
}
