<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'cidade';
    protected $primaryKey = 'cidcodibge';
}
