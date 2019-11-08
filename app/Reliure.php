<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reliure extends Model
{
    //
    protected $table = 'reliures';
    protected $fillable = ['libelle_reliure','prixUnitaire_reliure','imageReliure'];
    protected $primaryKey = 'id_reliure';
    public $timestamps = false;
}
