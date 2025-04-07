<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratLHS extends Model
{
    protected $table = "surat_lhs";
    protected $primaryKey = "id_surat_lhs";
    public $incrementing = false;
    public $increment = false;
    protected $fillable = [
        // 'id_surat_lhs',
        'id_pengajuan',
        'keperluan',
        'created_at',
    ];
    
    public $timestamps = true; // Untuk `created_at`
}
