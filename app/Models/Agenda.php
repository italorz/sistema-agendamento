<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $table='agenda';
    protected $primaryKey = 'id_agenda';
    protected $fillable = [
        'id_agenda',
        'data',
        'id_hora',
        'id_servico',
        'descricao',
        'id_usuario',
        'ativo'
    ];
    use HasFactory;
}
