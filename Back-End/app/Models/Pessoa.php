<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    use HasFactory;

    protected $table = 'pessoa';
    protected $primaryKey = 'pescodigo';

    public function profissao()
    {
        return $this->hasMany(Profissional::class, 'propescodigofk', 'pescodigo');
    }
}
