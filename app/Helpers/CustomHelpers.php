<?php

namespace App\Helpers;

class CustomHelpers{
    public static function generateSlug(){
        
    }
    public static function saveCategory($model,$name){
        $status = $model->create([
            'name'=>$name
        ]);
        return $status;
    }
}