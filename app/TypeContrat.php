<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeContrat extends Model
{
    //
    protected $table = 'typeContrat';
    protected $fillable = ['libelle_typeContrat','validite_contrat'];
    protected $primaryKey = 'id_typeContrat';
    public $timestamps = false;
}
