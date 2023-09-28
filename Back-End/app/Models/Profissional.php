<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profissional extends Model
{
    use HasFactory;

    protected $table = 'profissional';
    protected $primaryKey = 'procodigo';

    public function pessoa() {
        return $this->belongsTo(Pessoa::class, 'propescodigofk', 'pescodigo');
    }

    public function especialidade() {
        return $this->belongsTo(Especialidade::class, 'proespcodigofk', 'espcodigo');
    }
}
