@include('panel.edit.service',[
  'mainService' => 'vacunatorio',
  'details' => [
    'responsable' => 'responsable_vac',
    'ubicacion' => 'ubicacion_vac',
    'horario' => 'horario_vac',
    'mail' => 'mail_vac',
    'tel' => 'tel_vac',
    'web' => 'web_vac',
    'observasiones' => 'comentarios_vac'
  ]
])