@include('panel.edit.service',[
  'mainService' => 'condones',
  'details' => [
    'responsable' => 'responsable_distrib',
    'ubicacion' => 'ubicacion_distrib',
    'horario' => 'horario_distrib',
    'mail' => 'mail_distrib',
    'tel' => 'tel_distrib',
    'web' => 'web_distrib',
    'observasiones' => 'comentarios_distrib'
  ]
])