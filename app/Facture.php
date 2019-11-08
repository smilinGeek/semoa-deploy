<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    //
    protected $table = 'factures';
    protected $fillable = ['libelle_facture','montantTotal','montantPayer','montantRestant','date_facture','id_devi','id_livrer'];
    protected $primaryKey = 'id_facture'; 
    public $timestamps = true;
}
