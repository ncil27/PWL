<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Role extends Model
{
    use HasFactory;
    protected $fillable = ['role', 'id_role']; 
    protected $table = 'role';
    protected $primaryKey = 'id_role';
    protected $keyType = 'int'; // Tipe data primary key
}