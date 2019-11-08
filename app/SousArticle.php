<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SousArticle extends Model
{
    //
    protected $table = 'sousArticles';
    protected $fillable = ['titre_sousArticle','contenu_sousArticle','image_sousArticle','poster_sousArticle','id_article'];
    protected $primaryKey = 'id_sousArticle';
    public $timestamps = false;
}
