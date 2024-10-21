<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends BackendBaseController
{
    protected $base_route = 'backend.categories.';
    protected $base_view = 'backend.categories.';
    protected $panel = 'Category';

    protected $model;
    public function __construct(){
        $this->model = new Category();
    }
    public function create(){
        return view($this->__loadDataToView($this->base_view.'create'));
    }
}
