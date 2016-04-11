@extends('layouts.panel-master')

@section('content')

  <div class="home">
  <div class="section navigate">
      <div class="container">
        <div clas="row">
        <div class="col s12 l4">
          <form method="POST" action="../../password/reset">
            {!! csrf_field() !!}
            <input type="hidden" name="token" value="{{ $token }}">

            @if (count($errors) > 0)
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <div>
                Email
                <input type="email" name="email" value="{{ old('email') }}">
            </div>

            <div>
                Password
                <input type="password" name="password">
            </div>

            <div>
                Confirm Password
                <input type="password" name="password_confirmation">
            </div>

            <div class="row">
              <div class="valign-demo  valign-wrapper">
                <div class="valign full-width actions">
                  <button class="waves-effect waves-light btn btn-large full"
                  type="submit"><i class="mdi-action-done-all left"></i>
                    Reset Password</button>
                </div>
              </div>
            </div>
          </br>
          </div>
        </form>

      </div>
      </div>
  </div>
  <div class="section copy row">
      <div class="col s12 m6">
          <div class="valign-demo valign-wrapper content-block">
              <div class="valign">
                  <p><strong> BuscoCerrajero </strong> nuclea a todas las cerrajerías y cerrajeros del Argentina  atraves de una búsqueda ágil y simple para que pueda rapidamente lo que encontrar</p>
              </div>
          </div>
      </div>
      <div class="col s12 m6">
          <div class="valign-demo valign-wrapper center-align content-block">
              <div class="valign full-width actions">
                  <a href="http://www.trabex.com" target="_blank">
                    <img src="../images/logo-trabex.gif">
                  </a>
              </div>
          </div>
      </div>
  </div>
</div>
@stop
