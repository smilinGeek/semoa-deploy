<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Finition extends Model
{
    //
    protected $table = 'finitions';
    protected $fillable = ['libelle_finition','prixUnitaire_finition','imageFinition'];
    protected $primaryKey = 'id_finition';
    public $timestamps = false;
}
