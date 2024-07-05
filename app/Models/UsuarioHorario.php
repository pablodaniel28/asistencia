<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioHorario extends Model
{
    use HasFactory;

    protected $table = 'usuario_horarios'; // Asegúrate de definir el nombre de la tabla si es diferente

    protected $fillable = [
        'usuario_id',
        'horario_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function horario()
    {
        return $this->belongsTo(Horarios::class, 'horario_id');
    }

}
