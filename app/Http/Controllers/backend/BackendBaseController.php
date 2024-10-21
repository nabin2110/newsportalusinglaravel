<?php 
namespace App\Http\Controllers\backend;

use Illuminate\Support\Facades\View;

class BackendBaseController{
    public function __loadDataToView($file_path){
        View::composer($file_path,function($view){
            $view->with('panel',$this->panel);
            $view->with('base_route',$this->base_route);
            $view->with('base_view',$this->base_view);
        });

        return $file_path;
    }
}