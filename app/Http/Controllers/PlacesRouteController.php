<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\LocalidadRESTController;
use App\Http\Controllers\ProvinciaRESTController;
use App\Http\Controllers\PlacesRESTController;
use App\Provincia;
use DB;

class PlacesRouteController extends Controller
{
    static public function getAll(){

      return DB::table('places')
      ->join('provincia', 'places.idProvincia', '=', 'provincia.id')
      ->join('partido', 'places.idPartido', '=', 'partido.id')
      ->join('pais', 'places.idPais', '=', 'pais.id')
      // ->where('places.aprobado', 1)
      // ->where('places.abierta_24', 1)
      ->select()
      ->get();

  }



}
