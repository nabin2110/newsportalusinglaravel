@php
    $record = $data['record'] ?? null;
@endphp
<div class="col-lg-12">
    <div class="form-group">
        {!! Html::label('Enter category name*','name') !!}
        {!! Html::text('name',$record ?? old('name'))->placeholder('Enter category name*')->class('form-control') !!}
    </div>
    @include('backend.includes.field_validation',['input'=>'name'])
</div>