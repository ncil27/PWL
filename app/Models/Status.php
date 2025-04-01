<?php

namespace App\Models;

use App\Models\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;
    protected $fillable = ['status', 'id_status']; 
    protected $table = 'status';
    protected $primaryKey = 'id_status';
    protected $keyType = 'int';
}
