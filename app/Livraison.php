<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Livraison extends Model
{
    //
    protected $table = 'livraisons';
    protected $fillable = ['libelle_livraison'];
    protected $primaryKey = 'id_livraison';
    public $timestamps = false;
}
