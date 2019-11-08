<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Impression extends Model
{
    //
    protected $table = 'impressions';  
    protected $fillable = ['libelle_impression','valider_impression','date_impression','id_proposition','id_user'];
    protected $primaryKey = 'id_impression';
    public $timestamps = false;
}
