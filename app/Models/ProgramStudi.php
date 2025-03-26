<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class ProgramStudi extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'program_studi';
    protected $primaryKey = 'id_prodi'; // Menggunakan id_user sebagai primary key
    public $incrementing = false; // Tidak auto-increment karena VARCHAR
    protected $keyType = 'string'; // Primary key bertipe string

    public function users()
    {
        return $this->hasMany(User::class, 'id_prodi', 'id_prodi');
    }

}
