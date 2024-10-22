@extends('backend.layouts.section')
@section('title','Create '.$panel)
@section('main-section')

<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <div class="text-right m-3">
                <a href="{{ route($base_route.'index') }}" class="btn btn-info">All {{ $panel }}</a>
            </div>
            <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse"
                role="button" aria-expanded="true" aria-controls="collapseCardExample">
                <h6 class="m-0 font-weight-bold text-primary">Create {{ $panel }}</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="collapseCardExample">
                <div class="card-body">
                    {!! Html::form('POST',route($base_route.'store'))->id('form_validate')->attribute('enctype','multipart/form-data')->open() !!}
                        <div class="row">
                            @include($base_view.'includes.__form')
                        </div>
                        <div>
                            <button type="submit" class="btn btn-success" id="btn_submit">Save</button>
                        </div>
                    {!! Html::form()->close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script>
        $(function(){
            $('#form_validate').validate({
                rules:{
                    name:"required"
                },
                messages:{

                }
            })
        });
    </script>
@endsection