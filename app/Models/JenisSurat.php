<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisSurat extends Model
{
    use HasFactory;

    /*
    (0, 'Surat Keterangan Mahasiswa Aktif'),
    (1, 'Surat Pengantar Tugas'),
    (2, 'Laporan Hasil Studi'),
    (3, 'Surat Keterangan Lulus');
    */

    protected $table = 'jenis_surat';
    protected $primaryKey = 'kode_surat';
    // public $incrementing = false;
    protected $keyType = 'int';

    protected $fillable = [
        'kode_surat',
        'jenis_surat',
    ];
    public function pengajuans()
{
    return $this->hasMany(Pengajuan::class, 'kode_surat', 'kode_surat');
}
}
