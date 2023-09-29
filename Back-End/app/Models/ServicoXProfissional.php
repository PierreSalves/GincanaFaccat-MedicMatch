<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicoXProfissional extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'servicoXprofissional';
    protected $primaryKey = 'id';

    protected $fillable = [
        'idservico',
        'idprofissional'
    ];
}
