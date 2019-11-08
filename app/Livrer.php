<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Livrer extends Model
{
    //
    protected $table = 'livrer'; 
    protected $fillable = ['libelle_livrer','valider_livrer','date_livrer','valider_livraison_client','id_user','id_impression'];
    protected $primaryKey = 'id_livrer';
    public $timestamps = false;
}
