<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class entradas extends Model
{
    //Campos que se agregarán
    protected $fillable = [
        'titulo', 'contenido', 'imagen', 'categoria_id'
    ];

    //Obtiene la categoría de la receta vía llave foránea (FK)
    public function categoria()
    {
        return $this->belongsTo(CategoriaEntrada::class);
    }

    //Obtener la información del usuario vía FK
    public function autor()
    {
        return $this->belongsTo(User::class, 'user_id'); //user_id es la llave primaria (FK)
    }
}