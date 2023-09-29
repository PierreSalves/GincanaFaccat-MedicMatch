<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicoXProfissional extends Model
{
    use HasFactory;

    protected $table = 'servicoXprofissional';
    protected $primaryKey = 'id';

    protected $fillable = [
        'idservico',
        'idprofissional'
    ];
}
