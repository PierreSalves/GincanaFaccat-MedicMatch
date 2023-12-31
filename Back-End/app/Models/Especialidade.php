<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especialidade extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'especialidade';
    protected $primaryKey = 'espcodigo';

    public function servico()
    {
        return $this->hasMany(Servico::class, 'servespcodigofk', 'espcodigo');
    }
}
