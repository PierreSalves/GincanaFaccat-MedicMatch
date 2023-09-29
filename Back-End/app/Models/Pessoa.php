<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'pessoa';
    protected $primaryKey = 'pescodigo';

    protected $fillable = [
        'pesnome',
        'pessexo',
        'pesdatanascimento',
        'pesdocrg',
        'pesdoccpf',
        'pescontatotel1',
        'pescontatotel2',
        'pescontatoemail1',
        'pescontatoemail2',
        'pesendrua',
        'pesendnumero',
        'pesendbairro',
        'pesendcidcod',
        'pesendestcod',
        'pessituacao',
        'pesuserauth',
        'pesprodescricao',
        'pesprodescricaoservicos'
    ];

    public function profissao()
    {
        return $this->hasMany(Profissional::class, 'propescodigofk', 'pescodigo');
    }

    public function cidade()
    {
        return $this->belongsTo(Cidade::class, 'cidcodibge', 'pesendcidcod');
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'propescodigofk', 'pesendestcod');
    }
}
