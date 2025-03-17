<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    use HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id_user'; // Menggunakan id_user sebagai primary key
    public $incrementing = false; // Tidak auto-increment karena VARCHAR
    protected $keyType = 'string'; // Primary key bertipe string

    protected $fillable = [
        'id_user',
        'username',
        'name',
        'email',
        'password',
        'role',
        'status',
        'id_prodi'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

}
