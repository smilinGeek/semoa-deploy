<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contrat extends Model
{ 
    //
    protected $table = 'contrats';
    protected $fillable = ['libelle_contrat','remise_contrat','montant_contrat','date_signer','date_rompre','actif_contrat','id_user','id_typeContrat'];
    protected $primaryKey = 'id_contrat';
    public $timestamps = false;
}
