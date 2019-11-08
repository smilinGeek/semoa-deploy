<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Papier extends Model
{
    //
    protected $table = 'papiers';
    protected $fillable = ['libelle_papier','prixUnitaire_papier','imagePapier'];
    protected $primaryKey = 'id_papier';
    public $timestamps = false;
}
