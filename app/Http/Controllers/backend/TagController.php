<?php

namespace App\Http\Controllers\backend;

use App\Helpers\CustomHelpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\backend\TagRequest;
use App\Models\Tag;
use Exception;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class TagController extends BackendBaseController
{
    protected $base_route = 'backend.tags.';
    protected $base_view = 'backend.tags.';
    protected $panel = 'Tag';

    protected $model;
    public function __construct(){
        $this->model = new Tag();
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
                            ->orderBy('created_at','desc')
                            ->paginate($paginate);
        return view($this->__loadDataToView($this->base_view.'index'),compact('data'));
    }
    public function store(TagRequest $request){
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
    public function edit($id){
        $data['record'] = $this->model->findOrFail($id);
        return view($this->__loadDataToView($this->base_view.'edit'),compact('data'));
    }
    public function update(TagRequest $request,$id){
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
