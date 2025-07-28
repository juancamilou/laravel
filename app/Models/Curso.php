<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $table = 'cursos';

    protected $fillable = [
        'nombre',
        'descripcion',
        'miniatura',
    ];
    public function estudiantes()
{
    return $this->belongsToMany(User::class);
}
public function inscripciones()
{
    return $this->hasMany(Inscripcion::class);
}

public function usuarios()
{
    return $this->belongsToMany(User::class, 'inscripcions', 'curso_id', 'user_id');
}



}
