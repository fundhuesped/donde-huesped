{!!Form::open(['action'=>'EvaluationRESTController@store','method'=>'POST'])!!}
<div class="form-group">
    {!!Form::label('que_busca:')!!}
    {!!Form::text('que_busca',null,['class'=>'form-control','placeholder'=>''])!!}
</div>

<div class="form-group">
    {!!Form::label('le_dieron:')!!}
    {!!Form::text('le_dieron',null,['class'=>'form-control','placeholder'=>'le_dieron'])!!}
</div>

<div class="form-group">
    {!!Form::label('info_ok:')!!}
    {!!Form::number('info_ok',null,['class'=>'form-control','placeholder'=>''])!!}
</div>

<div class="form-group">
    {!!Form::label('privacidad_ok:')!!}
    {!!Form::number('privacidad_ok',null,['class'=>'form-control','placeholder'=>''])!!}
</div>

<div class="form-group">
    {!!Form::label('edad:')!!}
    {!!Form::number('edad',null,['class'=>'form-control','placeholder'=>''])!!}
</div>

<div class="form-group">
    {!!Form::label('genero:')!!}
    {!!Form::text('genero',null,['class'=>'form-control','placeholder'=>''])!!}
</div>

<div class="form-group">
    {!!Form::label('comentario:')!!}
    {!!Form::text('comentario',null,['class'=>'form-control','placeholder'=>''])!!}
</div>

<div class="form-group">
    {!!Form::label('voto:')!!}
    {!!Form::number('voto',null,['class'=>'form-control','placeholder'=>''])!!}
</div>

{!!Form::submit('mandar',['class'=>'btn btn-primary'])!!}
{!!Form::close()!!}