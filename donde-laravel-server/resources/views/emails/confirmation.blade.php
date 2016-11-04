<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Confirmacion</title>
  </head>

  <body>

    <p>
      Hola <strong>{!!Auth::user()->name!!} </strong>, tu usuario fue creado correctamente.
    </p>

    <p>
      Podes acceder a la plataforma con el correo
      <strong>{!!Auth::user()->email!!} </strong>
    </p>


  </body>
</html>
