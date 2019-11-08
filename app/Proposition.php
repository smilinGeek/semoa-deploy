<?php

namespace App;

use Illuminate\Database\Eloquent\Model; 

class Proposition extends Model
{
    //
    protected $table = 'propositions';
    protected $fillable = ['libelle_proposition','image1_proposition','image2_proposition','date_proposition','date_update_proposition','commentaire_proposition','choix_client','valider_proposition','id_devi','id_user'];
    protected $primaryKey = 'id_proposition';
    public $timestamps = false;
}
