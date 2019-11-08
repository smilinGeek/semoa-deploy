<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recu extends Model
{
    //
    protected $table = 'recus';
    protected $fillable = ['libelle_recu','date_emission','date_enregistrement','id_facture'];
    protected $primaryKey = 'id_recu';
    public $timestamps = false;
}
