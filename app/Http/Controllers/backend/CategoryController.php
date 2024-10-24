<?php

namespace App\Http\Controllers\backend;

use App\Helpers\CustomHelpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\backend\CategoryRequest;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

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
    public function index(){
        $search = request('search') ?? '';
        $paginate = request('per_page') ?? 10;
        $data['records'] = $this->model
                            ->when($search,function($query,$search){
                                $query->where('name','like','%'.$search.'%');
                            })
                            ->orderBy('rank')
                            ->paginate($paginate);
        return view($this->__loadDataToView($this->base_view.'index'),compact('data'));
    }
    public function store(CategoryRequest $request){
        try{
            $status = CustomHelpers::saveCategory($this->model,$request->name ?? null);
            $success_type = $status ? 'success' : 'error';
            $message = $this->panel.($status ? ' created successfully' : 'creation failed' );
            Alert::success($success_type,$message);
            return redirect()->route($this->base_route.'index');
        }catch(Exception $e){
            Alert::error('error','Something went wrong');
            return redirect()->back();
        }
    }
    public function sort(Request $request){
        $ids = $request->ids;
        $explode_ids = explode(',',$ids);
        print_r($explode_ids);
        foreach($explode_ids as $key=>$id){
            $record = $this->model->findOrFail($id);
            $record->rank = $key;
            $record->save();
        }
    }
    public function edit($id){
        $data['record'] = $this->model->findOrFail($id);
        return view($this->__loadDataToView($this->base_view.'edit'),compact('data'));
    }
    public function update(CategoryRequest $request,$id){
        $data['record'] = $this->model->findOrFail($id);
        try{
            $data_updated = $data['record']->update($request->all());
            $success_type = $data_updated ? 'success' : 'error';
            $message = $this->panel.($data_updated ? ' updated successfully' : ' couldn\'t update');
            Alert::success($success_type,$message);
            return redirect()->route($this->base_route.'index');
        }
        catch(Exception $e){
            Alert::error('error','Something went wrong...');
            return redirect()->back();
        }
    }
    public function destroy($id){
        $data['record'] = $this->model->findOrFail($id);
        $data_deleted = $data['record']->delete();
        $success_type = $data_deleted ? 'success' : 'error';
        $message = $this->panel.($data_deleted ? ' deleted successfully' : 'couldn\'t delete');
        Alert::success($success_type,$message);
        return redirect()->route($this->base_route.'index');
    }
}
