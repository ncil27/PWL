<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratSKMA extends Model
{
    use HasFactory;
    protected $table = "surat_mhs_aktif";
    protected $primaryKey = "id_surat_skma";
    protected $increment = false;
    protected $fillable = [
        // 'id_surat_skma',
        'id_pengajuan',
        'semester',
        'keperluan',
        'id_periode',
        'created_at',
    ];
    
    public $timestamps = true; // Untuk `created_at`

}
