{{-- Details debe especificarse así en cada servicio porque los nombres de los campos no son uniformes, so sad that happends --}}
@include('panel.edit.service',[
  'mainService' => 'prueba',
  'optService' => 'es_rapido',
  'details' => [
    'responsable' => 'responsable_testeo',
    'ubicacion' => 'ubicacion_testeo',
    'horario' => 'horario_testeo',
    'mail' => 'mail_testeo',
    'tel' => 'tel_testeo',
    'web' => 'web_testeo',
    'observasiones' => 'observaciones_testeo'
  ]
])