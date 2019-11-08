<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    // 
    protected $table = 'documents';
    protected $fillable = ['libelle_document','prixUnitaire_document','imageDocument'];
    protected $primaryKey = 'id_document';
    public $timestamps = false;
}
