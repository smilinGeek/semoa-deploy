<?php

namespace App; 

use Illuminate\Database\Eloquent\Model; 

class Devi extends Model  
{ 
    //
    protected $table = 'devis';
    protected $fillable = ['libelle_devi','titre_devi','nbre_exemplaire_devi','logo','contact1','contact2','contact3','adresse','recto_verso','couleur1','couleur2','couleur3','couleur4','image1','image2','image3','image4','date_devi','date_update_devi','valider','prix_total','comment_devi','reponse_devi','tnx_transfert','remise_devi','montant_restant' , 'montant_payer','id_contrat','id_reliure','id_finition','id_format','id_user','id_document','id_payement','id_papier','id_livraison'];
    protected $primaryKey = 'id_devi';
    public $timestamps = false; 
}
