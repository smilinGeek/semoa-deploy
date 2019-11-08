<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payement extends Model
{
    //
    protected $table = 'payements';
    protected $fillable = ['libelle_payement'];
    protected $primaryKey = 'id_payement';
    public $timestamps = false;
}
