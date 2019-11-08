<?php

namespace App;

use File;

use Storage;

use Illuminate\Support\Facades\Storage;

use Illuminate\Database\Eloquent\Model;

class FileUpload extends Model
{
    //
    public static function photo($request){

        $name = "";

            $extension = $request->extension(); 
            $name = rand(11111, 99999).".".date('Y-m-d').".".time().".".$extension;
            //Storage::disk('photo')->put($name, File::get($photo));
            return Storage::putFile('public/photo', $name);
            //$request->image->storeAs('public/photo',$name);

            $name = $name;

        return $name;

    }
}
