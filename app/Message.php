<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    protected $table = 'messages';
    protected $fillable = ['titre_message','contenu_message','image_message','reponse_message','date_message','date_update_message','lu_message','actif_message','id_user'];
    protected $primaryKey = 'id_message';
    public $timestamps = false; 
}
