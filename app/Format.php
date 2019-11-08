<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Format extends Model
{
    //
    protected $table = 'formats';
    protected $fillable = ['libelle_format','prixUnitaire_format','imageFormat'];
    protected $primaryKey = 'id_format';
    public $timestamps = false;
}
