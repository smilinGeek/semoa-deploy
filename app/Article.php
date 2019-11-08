<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model 
{
    //
    protected $table = 'articles';
    protected $fillable = ['titre_article','contenu_article','image_article','poster_article','id_user'];
    protected $primaryKey = 'id_article';
    public $timestamps = false;
}
