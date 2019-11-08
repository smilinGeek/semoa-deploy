<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maquette extends Model
{
    //
    protected $table = 'maquettes';
    protected $fillable = ['libelle_maquette','image_maquette','prix_maquette','poster_maquette','id_format','id_user','id_document'];
    protected $primaryKey = 'id_maquette';
    public $timestamps = false;
}
