<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class servico extends Model
{
    protected $table='servicos';
    protected $primaryKey = 'id_servico';
    protected $fillable = [
        'id_servico',
        'nome',
        'descricao',
        'valor'
    ];
    use HasFactory;
}
